<?php

namespace App\Services;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamService
{
    public function examCorrection(Request $request, Exam $exam)
    {
        $grade = 0;
        $fullmark = 0;
        foreach ($exam->examQuestions as $keyExamQuestion => $valueExamQuestion) {

            foreach ($request->all() as $keyRequest => $valueRequest) {
                if ($valueExamQuestion->correct == $valueRequest && $valueExamQuestion->id == $keyRequest) {
                    $grade += $valueExamQuestion->difficulty;
                }
            }
            $fullmark += $valueExamQuestion->difficulty;
        }
        return ['fullMark' => $fullmark, 'grade' => $grade];
    }
}
