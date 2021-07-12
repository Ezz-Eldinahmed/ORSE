<?php

namespace App\Http\Controllers\web\Mange;

use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Support\Facades\Storage;

class ResumeController
{
    public function show(Instructor $instructor, Category $category): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $inst = $instructor->categories()->where('category_id', $category->id)->first();

        return Storage::download($inst->pivot->resume);
    }
}
