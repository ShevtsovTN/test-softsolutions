<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ModelCarCollection extends ResourceCollection
{
    public $collects = ModelCarResource::class;
}
