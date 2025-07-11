<?php

namespace App\Http\Requests\AdminRequest\sub;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubRequest extends FormRequest
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
            'name' => 'required|unique:subs,name,' . $this->sub->id . ',id',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'status' => 'boolean',
        ];
    }
}
