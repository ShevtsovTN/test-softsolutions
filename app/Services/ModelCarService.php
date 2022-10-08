<?php

namespace App\Services;

use App\Models\ModelCar;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ModelCarService
{

    public function index(): LengthAwarePaginator
    {
        return ModelCar::query()->with('brand')->paginate(request('per_page', 15));
    }

    /**
     * @throws Exception
     */
    public function store(mixed $validated): ModelCar
    {
        DB::beginTransaction();

        try {

            /** @var ModelCar $modelCar */
            $modelCar = ModelCar::query()->create($validated);

            DB::commit();

            return $modelCar->load('brand');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function show(ModelCar $modelCar): ModelCar
    {
        return $modelCar->load('brand');
    }

    /**
     * @throws Exception
     */
    public function update(ModelCar $modelCar, mixed $validated): ModelCar
    {
        DB::beginTransaction();

        try {

            $modelCar->update($validated);

            DB::commit();

            return $modelCar->load('brand');

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function delete(ModelCar $modelCar): ModelCar
    {
        DB::beginTransaction();

        try {

            $modelCar->delete();

            DB::commit();

            return $modelCar->load('brand');

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
