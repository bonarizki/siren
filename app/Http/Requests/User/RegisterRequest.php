<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
                    'name' => 'required|string',
                    "id_card" => 'required|numeric|digits_between:16,16|unique:users,id_card',
                    "email" => 'required|email|unique:users,email',
                    "phone_number" => 'required|numeric|digits_between:12,12|unique:users,phone_number',
                    "password" => 'required|string|min:8',
                    "re_password" => 'required|string|min:8|same:password'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                // return [
                //     'brand_name' => 'required|string',
                //     'brand_code' => 'required|string|unique:brands,brand_code,' . $this->brand_code . ',brand_code',
                // ];
            }
            default:break;
        }
    }
}
