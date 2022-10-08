<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\ModelCar;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphMapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Relation::morphMap([
            'model'             => ModelCar::class,
            'brand'             => Brand::class,
            'car'               => Car::class,
            'user'              => User::class,
            'role'              => Role::class,
        ]);
    }
}
