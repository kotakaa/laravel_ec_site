<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'name_kana' => ['required', 'string'],
            'email' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'max:7', 'min:7'],
            'address' => ['required', 'string'],
        ];
    }
}
