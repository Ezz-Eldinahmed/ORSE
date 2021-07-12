<?php

namespace App\Http\Controllers\web\Learn;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;

class CategoryWebController
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        return redirect()->route('category.show', $this->categoryRepository->store($request));
    }

    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }
}
