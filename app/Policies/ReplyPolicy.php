<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function editReply(User $user, Reply $reply)
    {
        return $user == $reply->user;
    }

    public function bestReply(User $user, Reply $reply)
    {
        return $user == $reply->question->user;
    }
}
