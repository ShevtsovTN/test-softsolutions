<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ModelCar;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $models = ModelCar::query()->inRandomOrder()->limit(3)->get();
        foreach ($models as $model) {
            Car::factory()->for($model, 'model')->create();
        }
    }
}
