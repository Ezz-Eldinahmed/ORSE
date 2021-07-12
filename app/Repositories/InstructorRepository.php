<?php

namespace App\Repositories;

use App\Http\Requests\InstructorRequest;
use App\Http\Resources\ApiResource;
use App\Models\Category;
use App\Models\Instructor;
use App\Notifications\InstructorApproved;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class InstructorRepository
{
    public function index()
    {
        return Instructor::latest()->paginate(10);
    }

    public function store(InstructorRequest $request)
    {
        DB::beginTransaction();
        try {
            $instructor =  Instructor::firstOrCreate([
                'user_id' => auth()->user()->id,
                'approved' => 1,
            ]);

            if ($request->hasFile('resume')) {
                $resume = $request->file('resume')->store('resumes');

                $instructor->categories()->attach($request->category_id, [
                    'certification' =>  $request->certification,
                    'resume' => $resume,
                    'instructor_id' => $instructor->id,
                    'category_id' => $request->category_id
                ]);
            }
            DB::commit();
            return new ApiResource($instructor);
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function destroy(Instructor $instructor)
    {
        foreach ($instructor->categories()->get() as $value) {
            if (isset($value->pivot->resume)) {
                Storage::delete($value->pivot->resume);
            }
        }
        return $instructor->delete();
    }

    public function approve(Instructor $instructor, Category $category)
    {
        $instruct = $instructor->categories()
            ->where('categories.id', $category->id)
            ->first();

        if ($instruct->pivot->approved) {
            $instruct->pivot->approved = false;
            $instruct->pivot->save();
            return 'Removed successfully';
        } else {
            $instruct->pivot->approved = true;
            $instruct->pivot->save();

            Notification::send($instructor->user, new InstructorApproved($category));

            return 'Approved successfully';
        }
    }
}
