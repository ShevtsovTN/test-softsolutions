<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\ModelCar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'brand' => [
                'string',
                Rule::exists(Brand::class, 'name')
            ],
            'model' => [
                'string',
                Rule::exists(ModelCar::class, 'name')
            ],
            'rent' => [
                'numeric'
            ],
            'foto' => [
                'image'
            ],
            'year' => [
                'string',
                'min:4',
                'max:4',
            ],
            'register_number' => [
                'string',
                'min:4',
                'max:20',
            ],
            'color' => [
                'string'
            ],
            'kpp' => [
                'string'
            ]
        ];
    }
}
