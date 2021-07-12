<?php

namespace App\Models;

use App\Traits\Followable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    use Followable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function interviewer()
    {
        return $this->hasOne(Interviewer::class);
    }

    public function instructor()
    {
        return $this->hasOne(Instructor::class);
    }

    public function recommendation()
    {
        return $this->hasOne(Recommendation::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function timeline()
    {
        $friends = $this->follows()->pluck('id');
        return Post::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()
            ->paginate(10);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Post::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function view($video)
    {
        return $this->hasMany(View::class)
            ->where('viewable_type', 'App\Models\Video')
            ->where('viewable_id', $video->id)
            ->first();
    }

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password)) {
            $password = Hash::make($password);
        }
        $this->attributes['password'] = $password;
    }

    public function scopeSearchNameLikeOrEmail($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    public function scopeNotAuthUser($query)
    {
        return $query->where('id', '!=', (auth()->id()));
    }
}
