<?php

namespace App\Http\Controllers\web\Learn;

use App\Models\Question;
use App\Repositories\QuestionRepository;

class QuestionWebController
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        return view('question.index', ['questions' => Question::paginate(10)]);
    }

    public function show(Question $question)
    {
        return view('question.show', ['question' => $this->questionRepository->show($question)]);
    }
}
