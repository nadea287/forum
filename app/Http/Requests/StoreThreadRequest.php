<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreadRequest extends FormRequest
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
//            'subject' => 'required|min:10',
            'subject' => 'required',
//            'thread' => 'required|min:20',
            'thread' => 'required',
            'tag' => 'required',
        ];
    }
}
