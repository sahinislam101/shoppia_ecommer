<?php

namespace App\Http\Requests\AdminRequest\product;

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
            
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'uuid', 'exists:categories,id'],
            'sub_id' => ['nullable', 'uuid', 'exists:subs,id'],
            'brand_id' => ['nullable', 'uuid', 'exists:brands,id'],

            'small_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            'original_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['nullable', 'numeric', 'lte:original_price'],
            'stock' => ['required', 'integer', 'min:0'],

            'image' => ['nullable', 'url'],

            'explore' => ['boolean'],
            'flash_sales' => ['boolean'],
            'best_sell' => ['boolean'],
            'status' => ['boolean'],
        ];
    }
}
