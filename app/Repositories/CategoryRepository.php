<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryRepository
{
    public function index()
    {
        return Category::with('courses')->latest()->paginate(10);
    }

    public function store(CategoryRequest $request)
    {
        return Category::create($request->validated());
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return $category->update($request->validated());
    }

    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
