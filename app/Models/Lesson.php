<?php

namespace App\Models;

use App\Traits\CreatedByInstructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory, CreatedByInstructor;

    protected $fillable = ['name', 'description', 'course_id', 'instructor_id'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function seens()
    {
        return $this->morphMany(Seen::class, 'seenable');
    }
}
