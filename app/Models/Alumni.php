<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_code',
        'student_name_th',
        'student_surname_th',
        'student_name_en',
        'student_surname_en',
        'program_name',
        'faculty_name',
        'degree',
        'admit_year',
    ];
    // public function scopeSearch($query, $keyword)
    // {
    //     return $query->where('student_code', 'like', '%' . $keyword . '%')
    //                  ->orWhere('student_name_th', 'like', '%' . $keyword . '%')
    //                  ->orWhere('student_surname_th', 'like', '%' . $keyword . '%')
    //                  ->orWhere('program_name', 'like', '%' . $keyword . '%')
    //                  ->orWhere('degree', 'like', '%' . $keyword . '%');
    // }
    public function userAlumni()
    {
        return $this->belongsTo(UserAlumni::class);
    }
}
