<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Traits\WebResponse;
use App\Services\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use WebResponse;

    public function __construct(private CategoryService $service) {}

    public function index()
    {
        $categories = $this->service->all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('categories.create', compact('departments'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('categories.index', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $departments = Department::select('id', 'name');
        return view('categories.edit', compact('category', 'departments'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->service->update($category, $request->validated());
        return $this->redirectWithMessage('categories.index', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return $this->redirectWithMessage('categories.index', 'Category deleted.');
    }
}
