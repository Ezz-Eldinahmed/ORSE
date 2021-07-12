<?php

namespace App\Http\Controllers\web\Certify;

use App\Models\Course;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class ExamWebController
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function index()
    {
        return view('exam.index', ['exams' => Exam::with(['course', 'examQuestions'])->paginate(10)]);
    }

    public function store(Request $request, Course $course): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('exam.show', $this->examRepository->store($request, $course));
    }

    public function show(Exam $exam)
    {
        return view('exam.show', ['exam' => $exam->load('examQuestions')]);
    }

    public function take(Exam $exam)
    {
        return view('exam.take', ['exam' => $exam->load('examQuestions')]);
    }
}
