<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title_name',
        'name',
        'last_name',
        'mobile_number',
        'email',
        'password',
        'role_id',
        'status',
        'user_facebook',
        'user_linkedin',


    ];
    // การค้นหาข้อมูลผู้ใช้
    public function scopeSearch($query, $keyword)
    {
        return $query->where('title_name', 'like', '%' . $keyword . '%')
                     ->orWhere('name', 'like', '%' . $keyword . '%')
                     ->orWhere('last_name', 'like', '%' . $keyword . '%')
                     ->orWhere('email', 'like', '%' . $keyword . '%');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->title_name} {$this->name} {$this->last_name}";
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function work()
    {
        return $this->hasMany(Work::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }

    public function userAlumni()
    {
        return $this->belongsTo(UserAlumni::class);
    }

}




