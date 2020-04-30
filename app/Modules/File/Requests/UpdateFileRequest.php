<?php

namespace App\Modules\File\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\File\Models\File;


class UpdateFileRequest extends FormRequest
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
        $file = Request::input('file_link')?Request::input('file_link'):'';

        
        return [
            'title'       => 'required',
            'file_link'   => 'file|mimes:doc,Doc,DOC,DOCX,Docx,docx,txt,TXT,Txt,pdf,Pdf,PDF'.$file,

        ];

    }

}