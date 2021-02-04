<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', Rule::unique('products')->ignore($this->product)],
            'slug' => ['required', Rule::unique('products')->ignore($this->product)],
            'details' => 'nullable',
            'price' => 'required',
            'description' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
