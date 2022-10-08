<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            ModelCarSeeder::class,
            CarSeeder::class,
            UserSeeder::class
        ]);
    }
}
