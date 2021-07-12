<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\ApiResource;
use App\Models\Exam;

class ExamController
{
    public function show(Exam $exam): ApiResource
    {
        return new ApiResource($exam->load('examQuestions'));
    }
}
