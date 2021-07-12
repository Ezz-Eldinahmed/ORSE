<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\InstructorRequest;
use App\Http\Resources\ApiResource;
use App\Models\Category;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InstructorController
{
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApiResource
     */
    public function index(): ApiResource
    {
        return new ApiResource($this->instructorRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InstructorRequest $request
     * @return ApiResource
     */
    public function store(InstructorRequest $request): ApiResource
    {
        return new ApiResource($this->instructorRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Instructor $instructor
     * @return ApiResource
     */
    public function show(Instructor $instructor): ApiResource
    {
        return new ApiResource($instructor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Instructor $instructor
     * @return JsonResponse
     */
    public function destroy(Instructor $instructor): JsonResponse
    {
        $this->instructorRepository->destroy($instructor);

        return Response::json([
            'Message' => "Instructor Deleted Successfully"
        ], 200);
    }

    public function approve(Instructor $instructor, Category $category): string
    {
        return $this->instructorRepository->approve($instructor, $category);
    }
}
