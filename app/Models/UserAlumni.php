<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'alumni_id',

    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }
}
