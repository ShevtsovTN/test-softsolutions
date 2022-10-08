<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->has(Role::factory()->state([
            'role' => Role::ROLE_ADMINISTRATOR
        ]), 'roles')->create([
            'name' => 'admin',
            'email' => 'admin@test.com'
        ]);
    }
}
