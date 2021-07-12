<?php

namespace App\Repositories;

use App\Http\Requests\RateRequest;
use App\Http\Resources\ApiResource;
use App\Models\Course;
use App\Models\Rate;

class RateRepository
{
    public function store(Course $course, RateRequest $request)
    {
        $rate = $course->rates()->create([
            'rate' =>  $request->rate,
            'user_id' => auth()->user()->id
        ]);

        $course->instructor->rates()->create([
            'rate' =>  $request->rate,
            'user_id' => auth()->user()->id
        ]);

        return new ApiResource($rate);
    }


    public function update(RateRequest $request, Rate $rate)
    {
        return $rate->update($request->validated());
    }

    public function destroy(Rate $rate)
    {
        return $rate->delete();
    }
}
