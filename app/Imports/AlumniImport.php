<?php

namespace App\Imports;

use App\Models\AlumniImport as AlumniImportModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class AlumniImport implements
        ToModel,
        WithHeadingRow
{

    public function model(array $row)
    {
        $alumni = new AlumniImportModel([
            'student_code' =>  $row['studentcode'],
            'student_name_th' =>  $row['studentname'],
            'student_surname_th' =>  $row['studentsurname'],
            'student_name_en' =>  $row['studentnameeng'],
            'student_surname_en' =>  $row['studentsurnameeng'],
            'program_name' =>  $row['programname'],
            'faculty_name' =>  $row['facultyname'],
            'admit_year' =>  $row['admitacadyear'],
        ]);

        return $alumni;
    }
    /*public function rules(): array
    {
        return [
            'student_code' => 'required|unique:alumnis',
            'student_name_th' => 'required',
            'student_surname_th' => 'required',
            'student_name_en' => 'required',
            'student_surname_en' => 'required',
            'program_name' => 'required',
            'faculty_name' => 'required',
            'admit_year' => 'required',
        ];
    }*/

}
