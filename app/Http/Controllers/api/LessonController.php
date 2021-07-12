<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\LessonRequest;
use App\Http\Resources\ApiResource;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonController
{
    private $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function store(LessonRequest $request): ApiResource
    {
        return new ApiResource($this->lessonRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Lesson $Lesson
     * @return ApiResource
     */
    public function show(Lesson $Lesson): ApiResource
    {
        return new ApiResource($this->lessonRepository->show($Lesson)->load(['videos', 'comment']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest $request
     * @param Lesson $Lesson
     * @return ApiResource
     */
    public function update(LessonRequest $request, Lesson $Lesson)
    {
        $this->lessonRepository->update($request, $Lesson);
        return new ApiResource($Lesson);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lesson $Lesson
     * @return JsonResponse
     */
    public function destroy(Lesson $Lesson): JsonResponse
    {
        $this->lessonRepository->destroy($Lesson);

        return Response::json([
            'Message' => "Lesson Deleted Successfully"
        ], 200);
    }
}
