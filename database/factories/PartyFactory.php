<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Party>
 */
class PartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by'        => 1, // You can change this dynamically in seeder
            'type'              => 'cash',
            'goldIn'            => 0,
            'goldOut'           => 0,
            'cashIn'            => 0,
            'cashOut'           => 0,
            'totalWasteCasted'  => 0,
            'totalMazdoori'     => 0,
            'lastOrderDate'     => null,
            'IsActive'          => 1,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}
