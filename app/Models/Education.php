<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'depart_id',
        'student_number',
        'education_start',
        'education_end',
        'faculty',
        'university',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depart()
    {
        return $this->belongsTo(Department::class);
    }
}
