<?php

namespace App\Http\Controllers\web\Mange;

use App\Http\Requests\InterviewRequest;
use App\Models\Category;
use App\Models\Interviewer;
use App\Models\User;
use App\Repositories\InterviewerRepository;
use Illuminate\Http\RedirectResponse;

class InterviewerWebController
{
    private $interviewerRepository;

    public function __construct(InterviewerRepository $interviewerRepository)
    {
        $this->interviewerRepository = $interviewerRepository;
    }

    public function index()
    {
        return view(
            'Interviewer.index',
            ['interviewers' => Interviewer::with(['user', 'categories'])->paginate(10)]
        );
    }

    public function store(InterviewRequest $request, User $user): RedirectResponse
    {
        $request['user_id'] = $user->id;
        $data = $this->interviewerRepository->store($request);
        return back()->with($data['type'], $data['message']);
    }

    public function show(Interviewer $interviewer)
    {
        return view('Interviewer.show', ['interviewer' => $interviewer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Interviewer $interviewer
     * @return RedirectResponse
     */
    public function destroy(Interviewer $interviewer): RedirectResponse
    {
        $this->interviewerRepository->destroy($interviewer);
        return redirect()->route('interviewer.index')
            ->with('success', 'Interview Deleted Successfully');
    }

    public function approve(Interviewer $interviewer, Category $category): RedirectResponse
    {
        $return = $this->interviewerRepository->approve($interviewer, $category);
        return redirect()->route('interviewer.index')
            ->with('success', $return);
    }

    public function destroyCategory(Interviewer $interviewer, Category $category): RedirectResponse
    {
        $interviewer->categories()
            ->where('categories.id', $category->id)
            ->first()
            ->delete();

        return redirect()->route('interviewer.index')
            ->with('success', 'Interviewer Deleted Successfully');
    }
}
