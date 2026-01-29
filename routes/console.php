<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('sync:push-to-live', function () {
    $liveConnection = 'mysql_live';
    $localConnection = config('database.default');

    $livePort = (int) config('database.connections.mysql_live.port');
    if ($livePort === 22) {
        $this->error('LIVE_DB_PORT is 22 (SSH). MySQL uses port 3306.');
        $this->comment('In .env set: LIVE_DB_PORT=3306');
        $this->comment('Then run: php artisan config:clear');
        return 1;
    }

    // 1. Check connectivity to live DB — if offline, exit without error
    try {
        DB::connection($liveConnection)->getPdo();
        DB::connection($liveConnection)->getDatabaseName();
    } catch (\Throwable $e) {
        $this->comment('Offline or live DB unreachable. Skipping sync.');
        $this->error('  Reason: ' . $e->getMessage());
        $this->line('  Host: ' . config('database.connections.mysql_live.host') . ':' . config('database.connections.mysql_live.port'));
        $this->comment('  If live DB is on a remote server, set LIVE_DB_HOST to that server hostname/IP in .env (127.0.0.1 = this PC only).');
        return 0;
    }

    $tables = config('sync.tables', []);
    if (empty($tables)) {
        $this->warn('No syncable tables in config/sync.php.');
        return 0;
    }

    $pushed = 0;
    $localDb = config('database.connections.'.$localConnection.'.database');

    foreach ($tables as $table => $pk) {
        if (! Schema::connection($localConnection)->hasTable($table)) {
            continue;
        }
        if (! Schema::connection($localConnection)->hasColumn($table, 'synced_at')) {
            continue;
        }

        // If table doesn't exist on live, create it from local structure
        if (! Schema::connection($liveConnection)->hasTable($table)) {
            try {
                $createRow = DB::connection($localConnection)->selectOne('SHOW CREATE TABLE `'.str_replace('`', '``', $table).'`');
                $createSql = $createRow->{'Create Table'} ?? null;
                if ($createSql) {
                    DB::connection($liveConnection)->statement($createSql);
                    $this->line("Created table [{$table}] on live.");
                }
            } catch (\Throwable $e) {
                $this->error("Could not create table [{$table}] on live: " . $e->getMessage());
                continue;
            }
        }

        // If columns missing on live, add them from local definition
        $localColumns = DB::connection($localConnection)->select(
            'SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, EXTRA FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? ORDER BY ORDINAL_POSITION',
            [$localDb, $table]
        );
        $liveColumnsList = Schema::connection($liveConnection)->getColumnListing($table);
        foreach ($localColumns as $col) {
            if (in_array($col->COLUMN_NAME, $liveColumnsList, true)) {
                continue;
            }
            try {
                $null = $col->IS_NULLABLE === 'YES' ? 'NULL' : 'NOT NULL';
                $def = $col->COLUMN_DEFAULT;
                if ($def === null || $def === '') {
                    $default = '';
                } elseif (strtoupper((string) $def) === 'NULL' || strtoupper((string) $def) === 'CURRENT_TIMESTAMP') {
                    $default = ' DEFAULT ' . strtoupper((string) $def);
                } elseif (is_numeric($def)) {
                    $default = ' DEFAULT ' . $def;
                } else {
                    $default = " DEFAULT '" . addslashes($def) . "'";
                }
                $extra = ! empty($col->EXTRA) ? ' ' . $col->EXTRA : '';
                $colName = str_replace('`', '``', $col->COLUMN_NAME);
                $colType = $col->COLUMN_TYPE;
                DB::connection($liveConnection)->statement("ALTER TABLE `".str_replace('`', '``', $table)."` ADD COLUMN `{$colName}` {$colType} {$null}{$default}{$extra}");
                $this->line("Added column [{$table}.{$col->COLUMN_NAME}] on live.");
                $liveColumnsList[] = $col->COLUMN_NAME;
            } catch (\Throwable $e) {
                $this->warn("Could not add column [{$table}.{$col->COLUMN_NAME}]: " . $e->getMessage());
            }
        }

        $rows = DB::connection($localConnection)
            ->table($table)
            ->whereNull('synced_at')
            ->get();

        // Only push columns that exist on live (safety)
        $liveColumns = Schema::connection($liveConnection)->getColumnListing($table);

        foreach ($rows as $row) {
            $data = (array) $row;
            unset($data['synced_at']);
            $data = array_intersect_key($data, array_flip($liveColumns));
            $pkValue = $data[$pk] ?? null;
            if ($pkValue === null) {
                continue;
            }

            // ENUM / strict columns: empty string → NULL (see config/sync.php empty_string_to_null)
            $emptyToNull = config('sync.empty_string_to_null', []);
            foreach ($emptyToNull[$table] ?? [] as $col) {
                if (array_key_exists($col, $data) && $data[$col] === '') {
                    $data[$col] = null;
                }
            }

            try {
                DB::connection($liveConnection)->table($table)->updateOrInsert(
                    [$pk => $pkValue],
                    $data
                );
                DB::connection($localConnection)
                    ->table($table)
                    ->where($pk, $pkValue)
                    ->update(['synced_at' => now()]);
                $pushed++;
            } catch (\Throwable $e) {
                $this->error("Sync failed [{$table}.{$pk}={$pkValue}]: " . $e->getMessage());
            }
        }
    }

    if ($pushed > 0) {
        $this->info("Pushed {$pushed} row(s) to live.");
    }

    return 0;
})->purpose('Push only new/changed local rows (synced_at IS NULL) to the live database when online');

Artisan::command('sync:test-live-db', function () {
    $host = config('database.connections.mysql_live.host');
    $port = config('database.connections.mysql_live.port');
    $database = config('database.connections.mysql_live.database');
    $username = config('database.connections.mysql_live.username');

    $this->info('Trying live DB connection...');
    $this->line("  Host: {$host}");
    $this->line("  Port: {$port}");
    $this->line("  Database: {$database}");
    $this->line("  Username: {$username}");

    try {
        DB::connection('mysql_live')->getPdo();
        $name = DB::connection('mysql_live')->getDatabaseName();
        $this->info('OK — Connected to database: ' . $name);
        return 0;
    } catch (\Throwable $e) {
        $this->error('Failed: ' . $e->getMessage());
        $this->newLine();
        $this->comment('Check .env: LIVE_DB_HOST (hostname only, no https://), LIVE_DB_PORT (MySQL is usually 3306, not 22).');
        return 1;
    }
})->purpose('Test connection to live DB (check host/port from .env)');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('backup:decrypt {input : Path to .enc file} {output : Path for decrypted .sql file} {--password= : Backup password (default: from .env DB_BACKUP_PASSWORD)}', function () {
    $inputPath = $this->argument('input');
    $outputPath = $this->argument('output');
    $password = $this->option('password') ?: config('backup.db_backup_password');

    if (!file_exists($inputPath)) {
        $this->error("File not found: {$inputPath}");
        return 1;
    }
    if (empty($password)) {
        $this->error('Password required. Set DB_BACKUP_PASSWORD in .env or use --password=YourPassword');
        return 1;
    }

    $raw = file_get_contents($inputPath);
    if (strlen($raw) < 16 || substr($raw, 0, 8) !== 'Salted__') {
        $this->error('Invalid encrypted backup format (expected Salted__ header).');
        return 1;
    }

    $salt = substr($raw, 8, 8);
    $ciphertext = substr($raw, 16);
    $keyIv = hash_pbkdf2('sha256', $password, $salt, 10000, 48, true);
    $key = substr($keyIv, 0, 32);
    $iv = substr($keyIv, 32, 16);

    $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    if ($plaintext === false) {
        $this->error('Decryption failed. Check password.');
        return 1;
    }

    if (file_put_contents($outputPath, $plaintext) === false) {
        $this->error("Could not write output: {$outputPath}");
        return 1;
    }

    $this->info("Decrypted successfully → {$outputPath}");
    return 0;
})->purpose('Decrypt a backup .enc file created by the app (PHP encryption format)');
