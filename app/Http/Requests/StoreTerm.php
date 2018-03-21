<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTerm extends FormRequest
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
    public function attributes(){
        return [
            'date_started' => 'starting date',
        ];
    }
    public function rules()
    {
        return [
            'collector' => 'required',
            'date_started' => "required|date|unique:terms,start_date,null,null,end_date,null,location," .$this -> location,
            'location' => "required|string|unique:terms,location,null,null,end_date,null,start_date," .$this-> date_started
        ];
    }
}
