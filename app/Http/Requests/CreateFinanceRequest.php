<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFinanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'finance_classification' => 'bail|required|numeric|exists:finance_classifications,id',
            'debit_to' => 'bail|required|numeric',
            'currency' => 'bail|required|numeric|exists:currencies,id',
            'amount' => 'bail|required|numeric|min:0',
            'debt' => 'bail|nullable|numeric',
            'description' => 'bail|required|max:1000',
            'tithe' => 'bail|required|boolean|between:0,1',
            'fifth_part' => 'bail|required|boolean|between:0,1',
        ];
    }
}
