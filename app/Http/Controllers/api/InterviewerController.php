<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\InterviewRequest;
use App\Http\Resources\ApiResource;
use App\Models\Interviewer;
use App\Repositories\InterviewerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InterviewerController
{
    private $interviewerRepository;

    public function __construct(InterviewerRepository $interviewerRepository)
    {
        $this->interviewerRepository = $interviewerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApiResource
     */
    public function index(): ApiResource
    {
        return new ApiResource($this->interviewerRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InterviewRequest $request
     * @return ApiResource
     */
    public function store(InterviewRequest $request): ApiResource
    {
        return new ApiResource($this->interviewerRepository->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param Interviewer $interview
     * @return ApiResource
     */
    public function show(Interviewer $interview): ApiResource
    {
        return new ApiResource($interview);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Interviewer $interview
     * @return JsonResponse
     */
    public function destroy(Interviewer $interview): JsonResponse
    {
        $this->interviewerRepository->destroy($interview);

        return Response::json([
            'Message' => "Interviewer Deleted Successfully"
        ], 200);
    }
}
