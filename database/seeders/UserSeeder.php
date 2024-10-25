<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Paron',
            'email' => 'contact@paron.hu',
        ],);

        User::factory()->create([
            'name' => 'tesztaccount',
            'email' => 'tesztaccount@paron.hu',
        ],);

        User::factory(20)->create();
    }
}
