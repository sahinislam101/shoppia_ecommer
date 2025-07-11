<?php

namespace App\Http\Requests\AdminRequest\banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            
            'image' => ['required', 'string', 'url'],
            'link' => ['nullable', 'string', 'url'],
            'position' => ['required', 'in:top,middle,countdown'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
            'meta' => ['nullable', 'json'],
        ];
    }
}
