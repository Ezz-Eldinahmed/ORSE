<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\ApiResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CourseController
{
    private $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApiResource
     */
    public function index(): ApiResource
    {
        return new ApiResource($this->courseRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return ApiResource
     */
    public function store(CourseRequest $request): ApiResource
    {
        return new ApiResource($this->courseRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Course
     */
    public function show(Course $course): Course
    {
        return $this->courseRepository->show($course)->load(['lessons', 'exams', 'comment']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param Course $course
     * @return ApiResource
     */
    public function update(CourseRequest $request, Course $course): ApiResource
    {
        $this->courseRepository->update($request, $course);
        return new ApiResource($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return JsonResponse
     */
    public function destroy(Course $course): JsonResponse
    {
        $this->courseRepository->destroy($course);

        return Response::json([
            'Message' => "Course Deleted Successfully"
        ], 200);
    }
}
