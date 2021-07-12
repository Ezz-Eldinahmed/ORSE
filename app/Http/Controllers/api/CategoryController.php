<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\ApiResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CategoryController
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApiResource
     */
    public function index(): ApiResource
    {
        return new ApiResource($this->categoryRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return ApiResource
     */
    public function store(CategoryRequest $request): ApiResource
    {
        return new ApiResource($this->categoryRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return ApiResource
     */
    public function show(Category $category): ApiResource
    {
        return new ApiResource($category->load('courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return ApiResource
     */
    public function update(CategoryRequest $request, Category $category): ApiResource
    {
        $this->categoryRepository->update($request, $category);

        return new ApiResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->categoryRepository->destroy($category);

        return Response::json([
            'Message' => "Category Deleted Successfully"
        ], 200);
    }
}
