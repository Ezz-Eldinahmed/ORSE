<?php

namespace App\Models;

use App\Traits\CreatedByInstructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, CreatedByInstructor;

    protected $fillable =
    [
        'name',
        'description',
        'category_id',
        'instructor_id',
        'assignments',
        'speed',
        'presentation',
        'price',
        'approved'
    ];

    public function seens()
    {
        return $this->morphMany(Seen::class, 'seenable');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function rated(Course $course)
    {
        return Rate::where('user_id', auth()->user()->id)
            ->where('rateable_id', $course->id)
            ->where('rateable_type', 'App\Models\Course')->first();
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeOrderedByCreatedAt($query, $direction = 'asc')
    {
        return $query->orderBy('created_at', $direction);
    }

    public function scopeSearchNameLikeOrDescription($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    public function scopeWithModels($query, $with = '')
    {
        $query->with($with);
    }

    public function scopeApproved($query, $approved = 1)
    {
        return $query->where('approved', $approved);
    }

    public function scopeLearnSearch($query, $search)
    {
        return $query->approved(1)
            ->searchNameLikeOrDescription($search)
            ->withCount(['rates', 'users', 'seens'])
            ->withModels(['instructor']);
    }

    public function scopeApproveSearch($query, $search, $direction, $with)
    {
        return $query->searchNameLikeOrDescription($search)
            ->OrderedByCreatedAt($direction)
            ->withModels($with)
            ->paginate(10);
    }
}
