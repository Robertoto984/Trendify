<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Collection;

class SettingService
{
    public function all(): Collection
    {
        return Setting::select('id', 'logo', 'email', 'phone', 'address', 'facebook_url', 'instagram_url')->get();
    }

    public function create(array $data): Setting
    {
        return Setting::create($data);
    }

    public function update(Setting $setting, array $data): Setting
    {
        $setting->update($data);
        return $setting;
    }

    public function delete(Setting $setting): void
    {
        $setting->delete();
    }
}
