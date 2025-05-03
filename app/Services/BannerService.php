<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Support\Collection;

class BannerService
{
    public function all(): Collection
    {
        return Banner::select('id', 'title', 'photo', 'description', 'status')->get();
    }

    public function create(array $data): Banner
    {
        return Banner::create($data);
    }

    public function update(Banner $banner, array $data): Banner
    {
        $banner->update($data);
        return $banner;
    }

    public function delete(Banner $banner): void
    {
        $banner->delete();
    }
}
