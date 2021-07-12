<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\VideoRequest;
use App\Http\Resources\ApiResource;
use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

class VideoController
{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VideoRequest $request
     * @return ApiResource
     * @throws Throwable
     */
    public function store(VideoRequest $request): ApiResource
    {
        return new ApiResource($this->videoRepository->store($request));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VideoRequest $request
     * @param Video $video
     * @return ApiResource
     */
    public function update(VideoRequest $request, Video $video): ApiResource
    {
        $this->videoRepository->update($request, $video);
        return new ApiResource($video);
    }

    public function show(Video $video): ApiResource
    {
        return new ApiResource($this->videoRepository->show($video->load('comment')));
    }

    public function destroy(Video $video): JsonResponse
    {
        $this->videoRepository->destroy($video);

        return Response::json([
            'Message' => "Video Deleted Successfully"
        ], 200);
    }
}
