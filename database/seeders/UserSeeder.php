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
            //'username' => '@paron1',
            'email' => 'contact@paron.hu',
        ],);

        User::factory()->create([
            'name' => 'tesztaccount',
            //'username' => '@tesztaccount2',
            'email' => 'tesztaccount@paron.hu',
        ],);

        User::factory(20)->create();
    }
}
