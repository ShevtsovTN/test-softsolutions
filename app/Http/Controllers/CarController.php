<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Exception;

class CarController extends Controller
{

    private CarService $service;

    public function __construct(CarService $carService)
    {
        $this->service = $carService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CarCollection
     */
    public function index(): CarCollection
    {
        return CarCollection::make($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarRequest $request
     * @return CarResource
     * @throws Exception
     */
    public function store(StoreCarRequest $request): CarResource
    {
        return CarResource::make($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param Car $car
     * @return CarResource
     */
    public function show(Car $car): CarResource
    {
        return CarResource::make($this->service->show($car));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarRequest $request
     * @param Car $car
     * @return CarResource
     * @throws Exception
     */
    public function update(UpdateCarRequest $request, Car $car): CarResource
    {
        return CarResource::make($this->service->update($car, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return CarResource
     * @throws Exception
     */
    public function destroy(Car $car): CarResource
    {
        return CarResource::make($this->service->delete($car));
    }
}
