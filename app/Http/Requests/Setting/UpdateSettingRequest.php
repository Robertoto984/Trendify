<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'logo' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ];
    }
}
