<?php

namespace App\Repositories;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionRepository
{
    public function index()
    {
        return Question::latest()->with('replys')->paginate(10);
    }

    public function store(QuestionRequest $request)
    {
        return Question::create($request->validated());
    }

    public function update(QuestionRequest $request, Question $question)
    {
        return $question->update($request->validated());
    }

    public function destroy(Question $question)
    {
        return $question->delete();
    }

    public function show(Question $question)
    {
        if (Auth::check()) {
            $question->seens()->firstOrCreate([
                'user_id' => auth()->user()->id,
            ]);
        }

        return $question;
    }
}
