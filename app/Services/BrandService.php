<?php

namespace App\Services;

use App\Models\Brand;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BrandService
{

    public function index(): LengthAwarePaginator
    {
        return Brand::query()->paginate(request('per_page', 15));
    }

    /**
     * @throws Exception
     */
    public function store(array $validated): Brand
    {
        DB::beginTransaction();

        try {

            /** @var Brand $brand */
            $brand = Brand::query()->create($validated);

            DB::commit();

            return $brand;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

    /**
     * @param Brand $brand
     * @return Brand
     */
    public function show(Brand $brand): Brand
    {
        return $brand;
    }

    /**
     * @throws Exception
     */
    public function update(Brand $brand, mixed $validated): Brand
    {
        DB::beginTransaction();

        try {

            $brand->update($validated);

            DB::commit();

            return $brand;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function delete(Brand $brand): Brand
    {
        DB::beginTransaction();

        try {

            $brand->delete();

            DB::commit();

            return $brand;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
