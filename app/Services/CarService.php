<?php

namespace App\Services;

use App\Models\Car;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CarService
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Car::query()->with([
            'model.brand',
            'foto'
        ])->paginate(request('per_page', 15));
    }

    /**
     * @throws Exception
     */
    public function store(array $validated): Car
    {
        DB::beginTransaction();

        try {

            /** @var Car $car */
            $car = Car::query()->create($validated);

            DB::commit();

            return $car->load(['model.brand', 'foto']);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Car $car
     * @return Car
     */
    public function show(Car $car): Car
    {
        return $car->load(['model.brand', 'foto']);
    }

    /**
     * @throws Exception
     */
    public function update(Car $car, mixed $validated): Car
    {
        DB::beginTransaction();

        try {

            $car->update($validated);

            DB::commit();

            return $car->load(['model.brand', 'foto']);

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function delete(Car $car): Car
    {
        DB::beginTransaction();

        try {

            $car->delete();

            DB::commit();

            return $car->load(['model.brand', 'foto']);

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
