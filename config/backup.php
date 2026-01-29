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
    | Paths to backup tools (Windows)
    |--------------------------------------------------------------------------
    | When empty, these default to XAMPP locations. Set in .env if yours differ.
    */
    'mysqldump_path' => env('BACKUP_MYSQLDUMP_PATH', 'C:\\xampp\\mysql\\bin\\mysqldump.exe'),
    'openssl_path'   => env('BACKUP_OPENSSL_PATH', 'C:\\xampp\\apache\\bin\\openssl.exe'),
];