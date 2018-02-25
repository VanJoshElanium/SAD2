<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupply extends FormRequest
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

    public function attributes(){
        return [
            'supply_name' => 'item name',
            'supply_desc' => 'description',
            'supply_price' => 'price'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supply_name' => 'required|string|unique:inventories,inventory_name,null,null,inventory_status,1',
            'supply_desc' => 'required|string',
            'supply_price' => 'required|numeric|min:1',
        ];
    }
}
