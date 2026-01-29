<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add synced_at to tables used for offline→live sync.
     * Rows with synced_at = NULL are pushed when the PC is back online.
     */
    public function up(): void
    {
        $tables = array_keys(config('sync.tables', []));
        if (empty($tables)) {
            $tables = [
                'users', 'parties', 'orders', 'party_regular', 'party_cash',
                'stock_gold', 'stock_cashes', 'account_gold', 'account_cash', 'account_main',
                'account_history_cashes', 'account_history_gold',
                'expense_gold', 'expense_cash', 'waste_to_mazdoori', 'system_settings',
            ];
        }

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'synced_at')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->timestamp('synced_at')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        $tables = array_keys(config('sync.tables', []));
        if (empty($tables)) {
            $tables = [
                'users', 'parties', 'orders', 'party_regular', 'party_cash',
                'stock_gold', 'stock_cashes', 'account_gold', 'account_cash', 'account_main',
                'account_history_cashes', 'account_history_gold',
                'expense_gold', 'expense_cash', 'waste_to_mazdoori', 'system_settings',
            ];
        }

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'synced_at')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropColumn('synced_at');
                });
            }
        }
    }
};
