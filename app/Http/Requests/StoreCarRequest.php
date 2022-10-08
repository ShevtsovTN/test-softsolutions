<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'rent' => [
                'required',
                'number'
            ],
            'foto' => [
                'required',
                'image'
            ],
            'year' => [
                'required',
                'string'
            ],
            'register_number' => [
                'required',
                'string'
            ],
            'color' => [
                'required',
                'string'
            ],
            'kpp' => [
                'required',
                'string'
            ]
        ];
    }
}
