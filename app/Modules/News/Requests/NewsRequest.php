<?php

namespace App\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class NewsRequest extends FormRequest
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

        $image = Request::input('image_link')?Request::input('image_link'):'';

        return [
            'category_id' => 'required',
            'title'   => 'required|max:255',
            'slug' => 'required|max:100|unique:news,id'. $this->get('id'),
            'image_link'   => 'image|mimes:jpeg,png,jpg,gif|max:512'. $image,
            'status' => 'required',
            'excerpt' => 'required',
            'is_feature' => 'required',
            'tag' => 'required',
            'short_order' => 'integer',
        ];

    }

}