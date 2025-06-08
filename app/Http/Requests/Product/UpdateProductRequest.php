<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'is_new' => 'boolean',
            'featured_image_id' => ['nullable', 'exists:images,id'],
        ];
    }
}
