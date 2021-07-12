<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\ApiResource;
use App\Models\Certification;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class CertificationController
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function store(Request $request, Exam $exam): array
    {
        return $this->examRepository->examSubmit($request, $exam);
    }

    public function show(Certification $certification): ApiResource
    {
        return new ApiResource($certification);
    }
}
