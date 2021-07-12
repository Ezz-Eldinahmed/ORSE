<?php

namespace App\Http\Controllers\web\Certify;

use App\Models\Certification;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class CertificationWebController
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function store(Request $request, Exam $exam): \Illuminate\Http\RedirectResponse
    {
        $data = $this->examRepository->examSubmit($request, $exam);

        return redirect()->route('certification.show', $data['certification'])
            ->with('success', "Exam" . $data['status']);
    }

    public function show(Certification $certification)
    {
        return view('certification.show', ['certification' => $certification]);
    }
}
