<?php

namespace App\Repositories;

use App\Http\Requests\InterviewRequest;
use App\Http\Resources\ApiResource;
use App\Models\Category;
use App\Models\Interviewer;
use App\Models\User;
use App\Notifications\InterviewAdded;
use Illuminate\Support\Facades\Notification;

class InterviewerRepository
{
    public function index()
    {
        return Interviewer::latest()->paginate(10);
    }

    public function store(InterviewRequest $request)
    {
        $interviewer = Interviewer::firstOrCreate([
            'user_id' => $request->user_id,
            'approved' => 1
        ]);

        if ($interviewer->categories()->where('category_id', $request->category_id)->first() != null) {
            $interviewer->categories()->detach($interviewer->categories()->where('category_id', $request->category_id)->first());
            return ['message' => 'Deleted As Interviwer', 'type' => 'message'];
        } else {
            $interviewer->categories()->attach($interviewer->id, [
                'interviewer_id' => $interviewer->id,
                'approved' => 1,
                'category_id' => $request->category_id
            ]);

            $category = Category::findOrFail($request->category_id);

            Notification::send(
                $interviewer->user,
                new InterviewAdded($category, $interviewer->user)
            );

            return ['message' => 'Created Successfully', 'type' => 'success'];
        }
    }

    public function destroy(Interviewer $interviewer)
    {
        return $interviewer->delete();
    }

    public function approve(Interviewer $interviewer, Category $category)
    {
        $interviewer = $interviewer->categories()
            ->where('categories.id', $category->id)
            ->first();

        if ($interviewer->pivot->approved) {
            $interviewer->pivot->approved = false;
            $interviewer->pivot->save();
            return 'Removed successfully';
        } else {
            $interviewer->pivot->approved = true;
            $interviewer->pivot->save();

            $user = User::find($interviewer->user_id);
            Notification::send($user, new InterviewAdded($category, $user));
            return 'Approved successfully';
        }
    }
}
