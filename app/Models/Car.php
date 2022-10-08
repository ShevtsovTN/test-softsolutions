<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent',
        'foto',
        'year',
        'register_number',
        'color',
        'kpp'
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(ModelCar::class);
    }

    public function foto(): MorphMany
    {
        return $this->morphMany(File::class, 'entity');
    }
}
