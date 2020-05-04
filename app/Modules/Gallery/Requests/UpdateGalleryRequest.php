<?php

namespace App\Modules\Gallery\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\Gallery\Models\Gallery;


class UpdateGalleryRequest extends FormRequest
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
            'title'         => 'required|max:25',
            'discription'   => 'max:90',
            'image_link'    => 'image|mimes:jpeg,JPEG,Jpeg,PNG,Png,png,jpg,JPG,Jpg|max:5120'.$image,

        ];

    }

}