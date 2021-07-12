<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedByInstructor
{
    public static function bootCreatedByInstructor()
    {
        if (Auth::check() && auth()->user()->instructor != null) {
            static::creating(function ($model) {
                $model->instructor_id = auth()->user()->instructor->id;
            });
        }
    }
}
