<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CreatedBy;

    protected $fillable = ['name', 'description', 'user_id'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class)->withPivot('approved');
    }

    public function scopeSearchNameLikeOrDescription($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }
}
