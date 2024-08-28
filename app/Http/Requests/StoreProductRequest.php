<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'brand_id' => 'required|string|max:20',
            // 'brand_name' => 'required|string|max:255',
            // 'brand_active' => 'required|integer|max:1',

            'product_id' => 'required|string|max:20',
            'product_name' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'product_price' => 'required|integer',
            'product_stock' => 'required|integer',
            'product_active' => 'required|integer',
        ];
    }
}
