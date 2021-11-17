<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'address_type' => ['integer'],
            'payment_method' => ['string'],
            'address_id' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string', 'max:7', 'min:7'],
            'address' => ['nullable', 'string'],
        ];
    }
}
