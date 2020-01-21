<?php

namespace App\Modules\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\Tag\Models\Tag;


class TagRequest extends FormRequest
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
            'slug' => 'required|max:32|unique:tag,id'. $this->get('id'),
            'status' => 'required',
        ];

    }

}