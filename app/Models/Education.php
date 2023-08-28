<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'degreeName',
        'departName',
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
}
