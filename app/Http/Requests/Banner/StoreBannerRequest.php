<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ];
    }
}
