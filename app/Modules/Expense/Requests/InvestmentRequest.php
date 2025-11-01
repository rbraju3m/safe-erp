<?php

namespace App\Modules\Expense\Requests;

use Illuminate\Foundation\Http\FormRequest;


class InvestmentRequest extends FormRequest
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
            'project_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'investment_date' => 'required',
            'status' => 'required',
        ];

    }

}
