<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'exam_id',
        'course_id',
        'question',
        'difficulty',
        'correct',
        'a', 'b',
        'c', 'd'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
