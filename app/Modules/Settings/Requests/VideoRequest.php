<?php

namespace App\Modules\Settings\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\Settings\Models\Settings;


class VideoRequest extends FormRequest
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
            'title'   => 'required|max:255|unique:video,id'. $this->get('id'),
            'sort_order'   => 'required|integer',
            'video_link'   => 'required',
            'status' => 'required',
        ];

    }

}