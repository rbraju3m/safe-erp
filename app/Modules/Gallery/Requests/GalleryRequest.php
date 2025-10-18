<?php

namespace App\Modules\Gallery\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Gallery\Models\Gallery;

class GalleryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'discription' => 'nullable|max:255',
            'image_link' => $this->isMethod('post') ? 'required|image|mimes:jpeg,jpg,png|max:5120' : 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'folder' => 'required_without:new_folder',
            'new_folder' => [
                'required_if:folder,new_folder',
                'max:50',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && \App\Modules\Gallery\Models\Gallery::where('folder', $value)->exists()) {
                        $fail('This folder name already exists. Please choose a different name.');
                    }
                }
            ],

        ];
    }

    public function messages()
    {
        return [
            'folder.required_without' => 'Please select an existing folder or create a new folder.',
            'new_folder.required_if' => 'Please enter a new folder name.',
        ];
    }
}
