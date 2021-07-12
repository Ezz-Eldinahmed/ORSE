<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'view', 'level'];

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
