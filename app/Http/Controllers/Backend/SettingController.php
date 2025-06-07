<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use App\Traits\WebResponse;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;

class SettingController extends Controller
{
    use WebResponse;

    public function __construct(private SettingService $service) {}

    public function index()
    {
        $settings = $this->service->all();
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(StoreSettingRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('settings.index', 'Setting created successfully.');
    }

    public function show(Setting $setting)
    {
        return view('settings.show', compact('setting'));
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $this->service->update($setting, $request->validated());
        return $this->redirectWithMessage('settings.index', 'Setting updated.');
    }

    public function destroy(Setting $setting)
    {
        $this->service->delete($setting);
        return $this->redirectWithMessage('settings.index', 'Setting deleted.');
    }
}
