<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Payment;

class JoinCourseRepository
{
    public function store(Course $course)
    {
        return ($this->haveJoinedCourse($course) != null) ?
            true
            :

            auth()->user()->courses()->attach($course->id, [
                'course_id' => $course->id,
                'user_id' => auth()->user()->id
            ]);

        Payment::create([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
            'amount' => $course->price,
        ]);
    }

    public function payment(Course $course)
    {
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51HyGgPLfxWT4kkmEgV7XQptGezV13HWu4HuSq4sQM5dFDEa5AMs6EDPLyToHhSeyaikHqKUZ359KvvCvcf5mYXnA00mxUeXoMs');

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => "This Payment From ORSE",
            'amount' => $course->price * 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        $intent = $payment_intent->client_secret;

        return view('course.payment', compact(['intent', 'course']));
    }

    public function haveJoinedCourse(Course $course)
    {
        return auth()->user()->courses()->where('course_id', $course->id)->first();
    }
}
