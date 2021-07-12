<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'approved'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot(['approved', 'resume', 'certification']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function isInstructor($id)
    {
        if ($this->categories()->where('category_id', $id)->first() != null && $this->approved == 1) {
            return $this->categories()->where('category_id', $id)->first()->pivot->approved;
        }
        return false;
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function valueRate()
    {
        $rate = 0;
        foreach ($this->rates as $key => $value) {
            $rate += $value->rate;
        }
        return $rate;
    }
}
