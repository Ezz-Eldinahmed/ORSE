<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory, CreatedBy;

    protected $fillable = ['user_id', 'rateable_id', 'rate', 'rateable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rateable()
    {
        return $this->morphTo();
    }
}
