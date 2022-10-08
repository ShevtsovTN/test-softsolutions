<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\BrandService;
use Exception;

class BrandController extends Controller
{
    private BrandService $service;

    public function __construct(BrandService $brandService)
    {
        $this->service = $brandService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return BrandCollection
     */
    public function index(): BrandCollection
    {
        return BrandCollection::make($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBrandRequest $request
     * @return BrandResource
     * @throws Exception
     */
    public function store(StoreBrandRequest $request): BrandResource
    {
        return BrandResource::make($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return BrandResource
     */
    public function show(Brand $brand): BrandResource
    {
        return BrandResource::make($this->service->show($brand));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBrandRequest $request
     * @param Brand $brand
     * @return BrandResource
     * @throws Exception
     */
    public function update(UpdateBrandRequest $request, Brand $brand): BrandResource
    {
        return BrandResource::make($this->service->update($brand, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return BrandResource
     * @throws Exception
     */
    public function destroy(Brand $brand): BrandResource
    {
        return BrandResource::make($this->service->delete($brand));
    }
}
