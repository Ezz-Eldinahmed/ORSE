<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\JoinCourseRepository;
use Illuminate\Support\Facades\Response;

class JoinCourseController extends Controller
{
    public $joinCourseRepository;

    public function __construct(JoinCourseRepository $joinCourseRepository)
    {
        $this->joinCourseRepository = $joinCourseRepository;
    }

    public function join(Course $course)
    {
        return ($course->price > 0) ?
            $this->joinCourseRepository->payment($course) :
            $this->store($course);
    }

    public function store(Course $course): \Illuminate\Http\JsonResponse
    {
        return ($this->joinCourseRepository->store($course) == true) ?

            Response::json([
                'Message' => "You Have Already Joined"
            ], 200)
            :
            Response::json([
                'Message' => "Joined Successfully"
            ], 200);
    }
}
