<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniImport extends Model
{
    use HasFactory;
    protected $table = 'alumni_import';
    protected $fillable = [
        'student_code',
        'student_name_th',
        'student_surname_th',
        'student_name_en',
        'student_surname_en',
        'program_name',
        'faculty_name',
        'admit_year',
    ];

}
