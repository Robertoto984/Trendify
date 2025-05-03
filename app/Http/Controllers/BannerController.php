<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Traits\WebResponse;
use App\Services\BannerService;
use App\Http\Requests\Banner\StoreBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;

class BannerController extends Controller
{
    use WebResponse;

    public function __construct(private BannerService $service) {}

    public function index()
    {
        $banners = $this->service->all();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('banners.index', 'Banner created successfully.');
    }

    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $this->service->update($banner, $request->validated());
        return $this->redirectWithMessage('banners.index', 'Banner updated.');
    }

    public function destroy(Banner $banner)
    {
        $this->service->delete($banner);
        return $this->redirectWithMessage('banners.index', 'Banner deleted.');
    }
}
