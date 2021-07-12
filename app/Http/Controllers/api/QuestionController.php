<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\ApiResource;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuestionController
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApiResource
     */
    public function index(): ApiResource
    {
        return new ApiResource($this->questionRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return ApiResource
     */
    public function store(QuestionRequest $request): ApiResource
    {
        return new ApiResource($this->questionRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return ApiResource
     */
    public function show(Question $question): ApiResource
    {
        return new ApiResource($this->questionRepository->show($question)->load('replys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(QuestionRequest $request, Question $question)
    {
        if (auth()->user()->id == $question->user->id) {

            $this->questionRepository->update($request, $question);

            return new ApiResource($question);
        } else {
            return Response::json([
                'Message' => "unAuthorized"
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question): JsonResponse
    {
        if (auth()->user()->id == $question->user->id) {

            $this->questionRepository->destroy($question);

            return Response::json([
                'Message' => "Question Deleted Successfully"
            ], 200);
        } else {
            return Response::json([
                'Message' => "unAuthorized"
            ], 401);
        }
    }
}
