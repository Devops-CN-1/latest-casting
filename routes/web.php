<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\PartyController;
use App\Http\Controllers\API\StockController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SystemSettingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web', 'check.auth.token'])->group(function () {
    Route::get('party', [PartyController::class, 'createform'])->name('party.create.form');
    Route::get('advance', [PartyController::class, 'advanceform'])->name('advance.create.form');
    Route::post('check-stock-password', [StockController::class, 'checkPassword'])->name('check.stock.password');
    Route::post('/print-data', [StockController::class, 'printData'])->name('print.data');

    Route::middleware(['stock.password'])->group(function () {
        Route::get('stock', [StockController::class, 'stock'])->name('stock');
    });

    Route::post('logout', [AuthenticationController::class, 'logOut'])->name('logout');

    Route::get('/', [OrderController::class, 'create']);

    // Super admin only: system settings, backup, import, user management
    Route::middleware(['super.admin'])->group(function () {
        Route::get('/download-encrypted-backup', [SystemSettingController::class, 'downloadEncryptedBackup'])->name('backup.download');
        Route::get('system-settings', [SystemSettingController::class, 'systemsettingform']);
        Route::get('/import', [\App\Http\Controllers\ImportDbDataController::class, 'index'])->name('import.index');
        Route::get('/import/{table}', [\App\Http\Controllers\ImportDbDataController::class, 'showForm'])->name('import.form')->where('table', 'party-regular|parties|party-cash|account-cash|account-gold|account-history-cash|account-history-gold|account-main|expense-cash|expense-gold|orders|stock-cash|stock-gold');
        Route::post('/import/{table}', [\App\Http\Controllers\ImportDbDataController::class, 'upload'])->name('import.upload')->where('table', 'party-regular|parties|party-cash|account-cash|account-gold|account-history-cash|account-history-gold|account-main|expense-cash|expense-gold|orders|stock-cash|stock-gold');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });
});

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
