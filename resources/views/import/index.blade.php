@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Import Data</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Select a table to upload a CSV file and import data.</p>
    </div>

    <div class="grid gap-3 sm:grid-cols-2">
        <a href="{{ route('import.form', ['table' => 'party-regular']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📋</span>
            <span class="font-medium">Party Regular</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'parties']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">👥</span>
            <span class="font-medium">Parties</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'party-cash']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">💵</span>
            <span class="font-medium">Party Cash</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'account-cash']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">💰</span>
            <span class="font-medium">Account Cash</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'account-gold']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">🥇</span>
            <span class="font-medium">Account Gold</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'account-history-cash']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📜</span>
            <span class="font-medium">Account History Cash</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'account-history-gold']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📜</span>
            <span class="font-medium">Account History Gold</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'account-main']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📊</span>
            <span class="font-medium">Account Main</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'expense-cash']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📤</span>
            <span class="font-medium">Expense Cash</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'expense-gold']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📤</span>
            <span class="font-medium">Expense Gold</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'orders']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">🛒</span>
            <span class="font-medium">Orders</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'stock-cash']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📦</span>
            <span class="font-medium">Stock Cash</span>
        </a>
        <a href="{{ route('import.form', ['table' => 'stock-gold']) }}" 
           class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
            <span class="text-2xl">📦</span>
            <span class="font-medium">Stock Gold</span>
        </a>
    </div>

    <div class="mt-8">
        <a href="{{ url('/') }}" class="inline-flex items-center text-purple-600 dark:text-purple-400 hover:underline">
            ← Back to home
        </a>
    </div>
</div>
@endsection
