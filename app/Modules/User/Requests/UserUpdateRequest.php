<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\User\Models\User;


class UserUpdateRequest extends FormRequest
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
            'name'              => 'required|max:50',
            'mobile'            => 'required|max:11|min:4|unique:member,id'. $this->get('id'),

            'member_id'         => 'required|max:10',
            'national_id'       => 'required|max:20|min:8',
            'f_h_name'          => 'required|max:30',
            'nominee'           => 'required|max:30',
            'nominee_mobile'    => 'required|max:11|min:4',
            'nominee_n_id'      => 'required|max:20|min:8',
            'present_address'   => 'required|max:255',
            'parmanent_address' => 'required|max:255',
            'type'              => 'required',
            'religion'          => 'required',
            'gender'            => 'required',
            'image_link'   => 'image|mimes:jpeg,png,jpg|max:5120'.$image,
            'status'            => 'required',
        ];

    }

}