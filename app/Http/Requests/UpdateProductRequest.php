<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
//            'category_product_id' => 'required|exists:category_products,id',
//            'name' => 'required|string|max:50',
//            'price' => 'required|numeric|min:0',
//            'image' => 'required',

            'category_product_id' => 'required|exists:category_products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:10240|mimes:jpeg,jpg,gif,bmp,png',
        ];
    }
}
