<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelCarRequest;
use App\Http\Requests\UpdateModelCarRequest;
use App\Models\ModelCar;

class ModelCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModelCarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelCarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ModelCar $modelCar
     * @return \Illuminate\Http\Response
     */
    public function show(ModelCar $modelCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateModelCarRequest $request
     * @param ModelCar $modelCar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModelCarRequest $request, ModelCar $modelCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModelCar $modelCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelCar $modelCar)
    {
        //
    }
}
