<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ModelCar;
use Illuminate\Database\Seeder;

class ModelCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $brands = Brand::query()->inRandomOrder()->limit(3)->get();
        foreach ($brands as $brand) {
            ModelCar::factory()
                ->for($brand, 'brand')
                ->create();
        }
    }
}
