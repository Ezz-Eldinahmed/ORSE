<?php

namespace App\Models;

use App\Traits\CreatedByInstructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, CreatedByInstructor;

    protected $fillable = ['instructor_id', 'name', 'description', 'path', 'lesson_id'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function seens()
    {
        return $this->morphMany(Seen::class, 'seenable');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
