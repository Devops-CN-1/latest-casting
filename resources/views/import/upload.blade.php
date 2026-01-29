@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-xl">
    <div class="mb-6">
        <a href="{{ route('import.index') }}" class="text-purple-600 dark:text-purple-400 hover:underline mb-2 inline-block">← All imports</a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Import: {{ $title }}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">Upload a CSV file. Expected format: {{ $expectedFile ?? 'CSV with headers' }}</p>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ $uploadRoute }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-6 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800/50">
        @csrf

        <div>
            <label for="csv_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CSV file</label>
            <input type="file" 
                   name="csv_file" 
                   id="csv_file" 
                   accept=".csv,text/csv" 
                   required
                   class="block w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-medium file:bg-purple-50 file:text-purple-700 dark:file:bg-purple-900/30 dark:file:text-purple-300 hover:file:bg-purple-100 dark:hover:file:bg-purple-900/50">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" 
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
                Upload & Import
            </button>
            <a href="{{ route('import.index') }}" 
               class="px-6 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition font-medium">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
