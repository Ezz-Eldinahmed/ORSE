<?php

namespace App\Repositories;

use App\Http\Requests\ReplyRequest;
use App\Models\Question;
use App\Models\Reply;
use App\Notifications\ReplyAdded;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReplySetToBestReply;
use Illuminate\Support\Facades\Response;

class ReplyRepository
{
    public function store(ReplyRequest $request)
    {
        $question = Question::findOrFail($request->question_id);

        Notification::send(
            $question->user,
            new ReplyAdded(
                $question,
                auth()->user()
            )
        );

        return Reply::create([
            'answer' => $request->answer,
            'question_id' => $question->id
        ]);
    }

    public function update(ReplyRequest $request, Reply $reply)
    {
        return $reply->update($request->validated());
    }

    public function destroy(Reply $reply)
    {
        return $reply->delete();
    }

    public static function bestReply(Reply $reply)
    {
        if (auth()->user()->id == $reply->question->user->id) {
            if ($reply->question->bestReply == null) {
                $reply->question->bestReply = $reply->id;
                $reply->question->save();

                Notification::send(
                    $reply->user,
                    new ReplySetToBestReply(
                        $reply->question,
                    )
                );
            } else {
                $reply->question->bestReply = null;
                $reply->question->save();
            }
            return $reply->question->bestReply;
        } else {
            return Response::json([
                'Message' => "unAuthorized"
            ], 401);
        }
    }
}
