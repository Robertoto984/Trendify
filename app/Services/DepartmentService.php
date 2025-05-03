<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentService
{
    public function getAll(): Collection
    {
        return Department::select('id', 'name');
    }

    public function create(array $data): Department
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data): Department
    {
        $department->update($data);
        return $department;
    }

    public function delete(Department $department): void
    {
        $department->delete();
    }
}
