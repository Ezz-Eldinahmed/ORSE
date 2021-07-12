<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        if (Auth::check()) {
            static::creating(function ($model) {
                $model->user_id = auth()->user()->id;
            });
        }
    }
}
