<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChurchRequest extends FormRequest
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
            'country' => 'bail|required|numeric|exists:countries,id',
            'state' => 'bail|required|numeric|exists:provinces,id',
            'city' => 'bail|required|numeric|exists:cities,id',
            'name' => 'bail|required_with:custom_name|nullable|string|min:11|max:100|unique:churches',
            'number_of_church' => 'bail|required|numeric|min:1',
            'address' => 'bail|required|string|min:1|max:1000',
            'name_shepherd' => 'bail|required|string|max:100',
            'phone' => ['bail', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'condition' => 'bail|required|accepted',
             /*
                regex que valida el numero de tlf +58 4120840524

                %^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i
             */
        ];
    }
}
