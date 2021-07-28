<?php

namespace App\Modules\Bank\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
// use App\Modules\Expense\Models\Expense;


class BankRequest extends FormRequest
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
            'name'       => 'required',
            'amount'          => 'required',
            'ex_date'           => 'required',
            'status'            => 'required',
        ];

    }

}