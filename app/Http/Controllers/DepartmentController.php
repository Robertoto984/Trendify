<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\DepartmentService;
use App\Traits\WebResponse;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    use WebResponse;

    public function __construct(private DepartmentService $service) {}

    public function index()
    {
        $departments = $this->service->getAll();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('departments.index', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $this->service->update($department, $request->validated());
        return $this->redirectWithMessage('departments.index', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $this->service->delete($department);
        return $this->redirectWithMessage('departments.index', 'Department deleted.');
    }
}
