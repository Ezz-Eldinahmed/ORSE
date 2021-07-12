<?php

namespace App\Repositories;

use App\Models\Certification;
use App\Models\Course;
use App\Models\Exam;
use App\Services\ExamService;
use Illuminate\Http\Request;

class ExamRepository
{
    private $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'level' => 'required|in:1,2,3|unique:exams,level,NULL,id,course_id,' . $course->id
        ]);

        return Exam::create([
            'course_id' => $course->id,
            'level' => $validated['level'],
        ]);
    }

    public function examSubmit(Request $request, Exam $exam)
    {
        $data = $this->examService->examCorrection($request, $exam);

        $certification = Certification::create([
            'grade' => $data['grade'],
            'course_id' => $exam->course->id,
            'full_mark' => $data['fullMark'],
            'exam_id' => $exam->id,
            'status' => $this->status($data)
        ]);

        return ['status' => $this->status($data), 'certification' => $certification];
    }

    public function status($data)
    {
        return ($data['grade'] < $data['fullMark'] / 2) ?  'failed' : 'pass';
    }
}
