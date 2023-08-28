@extends('admin.index')

@section('title', 'Edit User')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขข้อมูลศิษย์เก่า</h1>

        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <form method="POST" action="{{ route('alumni.update',$alumni->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">

                        <!-- รหัสนักศึกษา -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">รหัสนักศึกษา</label>
                            <input type="text" class="form-control"
                                id="student_code" name="student_code"
                                value="{{ old('student_code') ? old('student_code') : $alumni->student_code }}" disabled>
                        </div>
                        <!-- ชื่อไทย -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ชื่อ ไทย</label>
                            <input type="text" class="form-control"
                                id="student_name_th" name="student_name_th"
                                value="{{ old('student_name_th') ? old('student_name_th') : $alumni->student_name_th }}">
                        </div>

                        <!-- สกุลไทย -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">นามสกุล ไทย</label>
                            <input type="text" class="form-control"
                                id="student_surname_th" name="student_surname_th"
                                value="{{ old('student_surname_th') ? old('student_surname_th') : $alumni->student_surname_th }}">
                        </div>
                        <!-- ชื่ออังกฤษ -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ชื่อ อังกฤษ</label>
                            <input type="text" class="form-control"
                                id="student_name_en" name="student_name_en"
                                value="{{ old('student_name_en') ? old('student_name_en') : $alumni->student_name_en }}">
                        </div>

                        <!-- สกุลอังกฤษ-->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">นามสกุล อังกฤษ</label>
                            <input type="text" class="form-control"
                                id="student_surname_en" name="student_surname_en"
                                value="{{ old('student_surname_en') ? old('student_surname_en') : $alumni->student_surname_en }}">
                        </div>

                        <!-- หลักสูตรวิชา -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">หลักสูตรวิชา</label>
                            <input type="text" class="form-control"
                                id="program_name" name="program_name"
                                value="{{ old('program_name') ? old('program_name') : $alumni->program_name }}" >
                        </div>
                        <!-- คณะ/วิทยาลัย -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">คณะ/วิทยาลัย</label>
                            <input type="text" class="form-control"
                                id="faculty_name" name="faculty_name"
                                value="{{ old('faculty_name') ? old('faculty_name') : $alumni->faculty_name }}" >
                        </div>
                        <!-- ปีที่เข้าศึกษา -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ปีที่เข้าศึกษา</label>
                            <input type="text" class="form-control"
                                id="admit_year" name="admit_year"
                                value="{{ old('admit_year') ? old('admit_year') : $alumni->admit_year }}" >
                        </div>
                        <!-- ระดับการศึกษา -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label  class="mb-2">ระดับการศึกษา</label>
                            <input disabled type="text" class="form-control"
                                id="degree" name="degree"
                                value=" @if ( $alumni->degree == 1 )
                                ปริญญาตรี
                                @elseif ($alumni->degree == 2)
                                ปริญญาโท
                                @elseif ($alumni->degree == 3)
                                ปริญญาเอก
                                @endif " >
                        </div>


                    </div>
                    <br>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success  float-right mb-3">บันทึก</button>
                        <a href="{{ route('alumni.indexAlumni') }}" class="btn btn-primary   float-right mb-3">
                            กลับ</a>
                    </div>
            </form>
        </div>

    </div>


@endsection
