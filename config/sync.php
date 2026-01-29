<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Syncable tables (local → live)
    |--------------------------------------------------------------------------
    | Only rows with synced_at = NULL are pushed. Order respects foreign keys.
    | Each entry: 'table_name' => 'primary_key_column'
    */
    'tables' => [
        'users' => 'id',
        'parties' => 'partyID',
        'orders' => 'id',
        'party_regular' => 'id',
        'party_cash' => 'partyID',
        'stock_gold' => 'id',
        'stock_cashes' => 'id',
        'account_gold' => 'id',
        'account_cash' => 'id',
        'account_main' => 'id',
        'account_history_cashes' => 'id',
        'account_history_gold' => 'id',
        'expense_gold' => 'id',
        'expense_cash' => 'id',
        'waste_to_mazdoori' => 'id',
        'system_settings' => 'id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Columns that must be NULL when value is empty string
    |--------------------------------------------------------------------------
    | ENUM columns do not accept ''. Use 'table_name' => ['col1', 'col2']
    */
    'empty_string_to_null' => [
        'orders' => ['selectOption'],
    ],
];
