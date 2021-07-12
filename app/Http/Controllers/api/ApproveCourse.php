<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\ApproveCourseRepository;
use Illuminate\Support\Facades\Response;

class ApproveCourse extends Controller
{
    public function store(Course $course): \Illuminate\Http\JsonResponse
    {
        return ApproveCourseRepository::store($course) ?
            Response::json([
                'Message' => "Course Approved Successfully",
            ], 200) :
            Response::json([
                'Message' => "Course Added To Pending",
            ], 200);
    }
}
