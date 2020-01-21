<?php

namespace App\Modules\BreakingNews\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\BreakingNews\Models\BreakingNews;


class BreakingNewsRequest extends FormRequest
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
            'title'   => 'required|max:255',
            'link' => 'required|max:255',
            'status' => 'required',
        ];

    }

}