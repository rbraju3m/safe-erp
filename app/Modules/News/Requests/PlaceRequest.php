<?php

namespace App\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PlaceRequest extends FormRequest
{
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
            'order' => 'required',
        ];

    }

}