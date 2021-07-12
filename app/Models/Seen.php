<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'seenable_id', 'seenable_type'];

    public function seenable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
