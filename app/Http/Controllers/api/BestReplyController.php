<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Repositories\ReplyRepository;
use Illuminate\Support\Facades\Response;

class BestReplyController extends Controller
{
    public function store(Reply $reply): \Illuminate\Http\JsonResponse
    {
        return (ReplyRepository::bestReply($reply) == null) ?
            Response::json([
                'Message' => "Reply Removed As Best Reply Successfully"
            ], 200) :
            Response::json([
                'Message' => "Reply Set To Best Reply Successfully"
            ], 200);
    }
}
