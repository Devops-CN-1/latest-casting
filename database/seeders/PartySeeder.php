<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Party;
use Illuminate\Support\Facades\Auth;

class PartySeeder extends Seeder
{
    public function run(): void
    {
        // When running from CLI Auth::id() is usually null; fallback to 1
        Party::factory()
            ->count(100)
            ->create([
                'created_by' => Auth::id() ?? 1,
                'type'       => 'cash', // ensure cash type
            ]);
    }
}
