<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand' => ['required', 'string'],
            'color' => ['required', 'string'],
            'purchase_date' => ['required', 'date'],
            'plate_number' => ['required', 'string']
        ];
    }
}
