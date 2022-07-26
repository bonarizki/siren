<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'email' => 'required|email|unique:users,email',
                    'phone_number' => 'required|numeric|unique:users,phone_number',
                    'id_card' => 'required|string|unique:users,id_card',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email,' . $this->email . ',email',
                    'phone_number' => 'required|numeric|unique:users,phone_number,' . $this->phone_number . ',phone_number',
                    'id_card' => 'required|string|unique:users,id_card,' . $this->id_card . ',id_card',
                ];
            }
            default:break;
        }
    }
}
