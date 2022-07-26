<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                    'brand_name' => 'required|string',
                    'brand_code' => 'required|string|unique:brands,brand_code',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'brand_name' => 'required|string',
                    'brand_code' => 'required|string|unique:brands,brand_code,' . $this->brand_code . ',brand_code',
                ];
            }
            default:break;
        }
    }
}
