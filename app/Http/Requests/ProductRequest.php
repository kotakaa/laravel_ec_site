<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'genre' =>     ['required', 'integer'],
            'is_active' =>       ['required'],
            'name' =>         ['required', 'string', 'max:200'],
            'introduction' => ['required', 'string', 'max:1000'],
            'price' =>        ['required', 'integer', 'min:300', 'max:9999999'],
            'image' =>        ['required', 'file', 'image'],
        ];
    }
}
