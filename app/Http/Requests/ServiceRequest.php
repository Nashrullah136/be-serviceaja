<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
            'motor_id' => ['required', Rule::exists('motors', 'id')->where(function ($query){
                return $query->where('user_id', Auth::user()->id);
            })],
            'location' => ['required', 'string'],
            'service_date' => ['required', 'date'],
            'fixes' => ['string']
        ];
    }
}
