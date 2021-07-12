<?php

namespace App\Http\Controllers\web\Mange;

use App\Models\Category;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use Illuminate\Http\RedirectResponse;

class ApproveInstructorController
{
    /**
     * @var InstructorRepository
     */
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }
    /*
     * Show the form for editing the specified resource.
     *
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function store(Instructor $instructor, Category $category): RedirectResponse
    {
        return redirect()->route('instructor.index')
            ->with('success', $this->instructorRepository->approve($instructor, $category));
    }
}
