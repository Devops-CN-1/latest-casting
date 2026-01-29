<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SystemSettingController extends Controller
{
    public function systemsettingform(){
            $system_settings = SystemSetting::first();
            return view('system_settings',compact('system_settings'));
    }
    public function save(Request $request)
    {
        
        $validated = $request->validate([
            'gold_rate'     => 'required|numeric|min:0',
            'gram_rate'     => 'required|numeric|min:0',
            'software_name' => 'required|string|max:255',
        ]);

        // Always update first record (single settings row)
        $setting = SystemSetting::first();

        if ($setting) {
            $setting->update($validated);
        } else {
            $setting = SystemSetting::create($validated);
        }

        return response()->json([
            'message' => 'System settings saved successfully!',
            'data'    => $setting
        ]);
    }

    public function updateRates(Request $request)
    {
        $validated = $request->validate([
            'gold_rate' => 'required|numeric|min:0',
            'gram_rate' => 'required|numeric|min:0',
        ]);

        // Always update first record (single settings row)
        $setting = SystemSetting::first();

        if ($setting) {
            // Update only gold_rate and gram_rate, preserve software_name
            $setting->update([
                'gold_rate' => $validated['gold_rate'],
                'gram_rate' => $validated['gram_rate']
            ]);
        } else {
            // If no setting exists, create with default software_name
            $validated['software_name'] = 'Casting Management System';
            $setting = SystemSetting::create($validated);
        }

        return response()->json([
            'message' => 'Rates updated successfully!',
            'data'    => $setting
        ]);
    }

    public function downloadEncryptedBackup(Request $request)
{
    // 1) config
    $timestamp = now()->format('Y-m-d_H-i-s');
    $tmpDir = storage_path('app/db_backups');
    if (!file_exists($tmpDir)) {
        mkdir($tmpDir, 0755, true);
    }

    $sqlFilename = "backup_{$timestamp}.sql";
    $sqlFilepath = $tmpDir . DIRECTORY_SEPARATOR . $sqlFilename;
    $encFilename = $sqlFilename . '.enc';
    $encFilepath = $tmpDir . DIRECTORY_SEPARATOR . $encFilename;

    // Load DB credentials from env/config
    $dbHost = config('database.connections.mysql.host', env('DB_HOST', '127.0.0.1'));
    $dbPort = config('database.connections.mysql.port', env('DB_PORT', '3306'));
    $dbUser = config('database.connections.mysql.username', env('DB_USERNAME', 'root'));
    $dbPass = config('database.connections.mysql.password', env('DB_PASSWORD', ''));
    $dbName = config('database.connections.mysql.database', env('DB_DATABASE'));
    

    $encPassword = config('backup.db_backup_password');
    if (empty($encPassword)) {
        return abort(500, 'Encryption password not configured. Set DB_BACKUP_PASSWORD in .env');
    }

    $mysqldumpPath = config('backup.mysqldump_path', 'C:\\xampp\\mysql\\bin\\mysqldump.exe');
    if (PHP_OS_FAMILY === 'Windows' || str_contains($mysqldumpPath, ' ')) {
        $mysqldumpPath = '"' . trim($mysqldumpPath, '"') . '"';
    }

    $passOption = $dbPass === '' ? '' : '-p' . $dbPass;
    $hostOption = $dbHost ? '-h ' . escapeshellarg($dbHost) : '';
    $portOption = $dbPort ? '--port=' . escapeshellarg($dbPort) : '';

    $dumpCommand = "{$mysqldumpPath} -u " . escapeshellarg($dbUser) . " {$passOption} {$hostOption} {$portOption} " . escapeshellarg($dbName) . " > " . escapeshellarg($sqlFilepath);
    try {
        // 2) Run mysqldump
        exec($dumpCommand . ' 2>&1', $output, $returnVar);
        if ($returnVar !== 0) {
            Log::error('mysqldump failed', ['cmd' => $dumpCommand, 'output' => $output]);
            return abort(500, 'Database export failed. Check logs.');
        }

        // Optional: check SQL file is not empty
        if (!file_exists($sqlFilepath) || filesize($sqlFilepath) === 0) {
            Log::error('SQL dump file is empty', ['file' => $sqlFilepath]);
            return abort(500, 'SQL dump failed or empty. Check logs.');
        }

        // 3) Encrypt with PHP OpenSSL (no external openssl.exe - avoids "This app can't run on your PC")
        $plaintext = file_get_contents($sqlFilepath);
        $salt = random_bytes(8);
        $keyIv = hash_pbkdf2('sha256', $encPassword, $salt, 10000, 48, true);
        $key = substr($keyIv, 0, 32);
        $iv = substr($keyIv, 32, 16);
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if ($ciphertext === false) {
            Log::error('PHP openssl_encrypt failed');
            if (file_exists($sqlFilepath)) unlink($sqlFilepath);
            return abort(500, 'Encryption failed.');
        }
        $encrypted = 'Salted__' . $salt . $ciphertext;
        if (file_put_contents($encFilepath, $encrypted) === false) {
            Log::error('Could not write encrypted backup file');
            if (file_exists($sqlFilepath)) unlink($sqlFilepath);
            return abort(500, 'Could not write backup file.');
        }

        // 4) Remove the plain SQL file
        if (file_exists($sqlFilepath)) {
            unlink($sqlFilepath);
        }

        // 5) Return download response
        return response()->download($encFilepath, $encFilename)->deleteFileAfterSend(true);

    } catch (\Throwable $e) {
        Log::error('Backup exception', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        if (file_exists($sqlFilepath)) unlink($sqlFilepath);
        if (file_exists($encFilepath)) unlink($encFilepath);
        return abort(500, 'An unexpected error occurred. Check logs.');
    }
}

}