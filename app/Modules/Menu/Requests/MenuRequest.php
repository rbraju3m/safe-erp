<?php

namespace App\Modules\Menu\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\Menu\Models\Menu;


class MenuRequest extends FormRequest
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
            'name'   => 'required|max:255',
            'status' => 'required',
        ];

    }

}