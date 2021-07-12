<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviewer extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'user_id', 'approved'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot(['approved']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isInterviewer($id)
    {
        if ($this->categories()->where('category_id', $id)->first() != null) {
            return $this->categories()->where('category_id', $id)->first()->pivot->approved;
        }
        return false;
    }
}
