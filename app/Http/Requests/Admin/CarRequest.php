<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    'car_name' => 'required|string',
                    'car_seat' => 'required|numeric',
                    'car_price' => 'required|string',
                    'brand_id' => 'required|exists:brands,id',
                    'type_id' => 'required|exists:types,id',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'car_name' => 'required|string',
                    'car_seat' => 'required|numeric',
                    'car_price' => 'required|numeric',
                    'brand_id' => 'required|exists:brands,id',
                    'type_id' => 'required|exists:types,id',
                ];
            }
            default:break;
        }
    }
}
