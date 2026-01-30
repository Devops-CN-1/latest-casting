<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Database Backup Password
    |--------------------------------------------------------------------------
    |
    | This password will be used to encrypt your database backups.
    |
    */

    'db_backup_password' => env('DB_BACKUP_PASSWORD', null),

    /*
    |--------------------------------------------------------------------------
    | Paths to backup tools
    |--------------------------------------------------------------------------
    | Windows: defaults to XAMPP. Linux/macOS: use "mysqldump" (from PATH).
    | Set BACKUP_MYSQLDUMP_PATH in .env if your binary is elsewhere
    | (e.g. /usr/bin/mysqldump or /usr/local/bin/mysqldump).
    */
    'mysqldump_path' => env('BACKUP_MYSQLDUMP_PATH', PHP_OS_FAMILY === 'Windows'
        ? 'C:\\xampp\\mysql\\bin\\mysqldump.exe'
        : 'mysqldump'),
    'openssl_path'   => env('BACKUP_OPENSSL_PATH', PHP_OS_FAMILY === 'Windows'
        ? 'C:\\xampp\\apache\\bin\\openssl.exe'
        : 'openssl'),
];