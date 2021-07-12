<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ReplyRequest;
use App\Http\Resources\ApiResource;
use App\Models\Reply;
use App\Repositories\ReplyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ReplyController
{
    private $replyRepository;

    public function __construct(ReplyRepository $replyRepository)
    {
        $this->replyRepository = $replyRepository;
    }

    public function store(ReplyRequest $request): ApiResource
    {
        $reply = $this->replyRepository->store($request);

        return new ApiResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReplyRequest $request
     * @param Reply $reply
     * @return ApiResource
     */
    public function update(ReplyRequest $request, Reply $reply): ApiResource
    {
        if (auth()->user()->id == $reply->user->id) {
            $this->replyRepository->update($request, $reply);

            return new ApiResource($reply);
        } else {
            return Response::json([
                'Message' => "unAuthorized"
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return JsonResponse
     */
    public function destroy(Reply $reply): JsonResponse
    {
        if (auth()->user()->id == $reply->user->id) {

            $this->replyRepository->destroy($reply);

            return Response::json([
                'Message' => "Reply Deleted Successfully"
            ], 200);
        } else {
            return Response::json([
                'Message' => "unAuthorized"
            ], 401);
        }
    }
}
