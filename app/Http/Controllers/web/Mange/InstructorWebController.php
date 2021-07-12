<?php

namespace App\Http\Controllers\web\Mange;

use App\Http\Requests\InstructorRequest;
use App\Models\Category;
use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class InstructorWebController
{
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    public function index()
    {
        return view(
            'Instructor.index',
            ['instructors' => Instructor::with(['user', 'categories'])->paginate(10)]
        );
    }

    public function create()
    {
        return view('Instructor.create', ['categories' => Category::all(['id', 'name'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InstructorRequest $request
     * @return RedirectResponse
     */
    public function store(InstructorRequest $request): RedirectResponse
    {
        $this->instructorRepository->store($request);
        return redirect()->route('home')
            ->with('success', 'Your Request Have Been Added Success We will Contact You Soon');
    }

    public function show(Instructor $instructor)
    {
        return view('Instructor.show', ['instructor' => $instructor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function destroy(Instructor $instructor): RedirectResponse
    {
        $this->instructorRepository->destroy($instructor);
        return redirect()->route('instructor.index')
            ->with('success', 'Instructor Deleted Successfully');
    }

    public function destroyCategory(Instructor $instructor, Category $category): RedirectResponse
    {
        $instruct = $instructor->categories()
            ->where('categories.id', $category->id)
            ->first();

        Storage::delete($instruct->pivot->resume);
        $instruct->delete();

        return redirect()->route('instructor.index')
            ->with('success', 'Instructor Deleted Successfully');
    }
}
