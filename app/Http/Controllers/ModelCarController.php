<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelCarRequest;
use App\Http\Requests\UpdateModelCarRequest;
use App\Http\Resources\ModelCarCollection;
use App\Http\Resources\ModelCarResource;
use App\Models\ModelCar;
use App\Services\ModelCarService;
use Exception;

class ModelCarController extends Controller
{
    private ModelCarService $service;

    public function __construct(ModelCarService $modelCarService)
    {
        $this->service = $modelCarService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return ModelCarCollection
     */
    public function index(): ModelCarCollection
    {
        return ModelCarCollection::make($this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModelCarRequest $request
     * @return ModelCarResource
     * @throws Exception
     */
    public function store(StoreModelCarRequest $request): ModelCarResource
    {
        return ModelCarResource::make($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param ModelCar $modelCar
     * @return ModelCarResource
     */
    public function show(ModelCar $modelCar): ModelCarResource
    {
        return ModelCarResource::make($this->service->show($modelCar));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateModelCarRequest $request
     * @param ModelCar $modelCar
     * @return ModelCarResource
     * @throws Exception
     */
    public function update(UpdateModelCarRequest $request, ModelCar $modelCar): ModelCarResource
    {
        return ModelCarResource::make($this->service->update($modelCar, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModelCar $modelCar
     * @return ModelCarResource
     * @throws Exception
     */
    public function destroy(ModelCar $modelCar): ModelCarResource
    {
        return ModelCarResource::make($this->service->delete($modelCar));
    }
}
