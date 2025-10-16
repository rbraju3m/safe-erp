<?php

namespace App\Modules\Deposit\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Modules\Deposite\Models\Deposit;


class DepositRequest extends FormRequest
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
            'member_id'       => 'required',
            'month'          => 'required',
            'year'           => 'required',
            'type'    => 'required',
            'amount'      => 'required|max:6|min:3',
            'status'            => 'required',
        ];

    }

}
