<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Models\Course;
use App\Repositories\RateRepository;

class RateController extends Controller
{
    private $rateRepository;

    public function __construct(RateRepository $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function store(Course $course, RateRequest $request): \App\Http\Resources\ApiResource
    {
        return $this->rateRepository->store($course, $request);
    }
}
