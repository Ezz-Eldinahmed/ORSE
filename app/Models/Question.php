<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, CreatedBy;

    protected $fillable = ['question', 'category_id', 'user_id'];

    public function replys()
    {
        return $this->hasMany(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seens()
    {
        return $this->morphMany(Seen::class, 'seenable');
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeQuestionFilter($query, $search, $with)
    {
        return $query->where('question', 'LIKE', "%{$search}%")
            ->with($with)
            ->withCount('seens');
    }
}
