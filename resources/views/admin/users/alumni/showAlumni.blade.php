@extends('admin.index')

@section('title', 'Show')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลศิษย์เก่า</h1>
        </div>

        <div class="card mb-3">
            <div class="card-body">
              <div class="mt-2">
                <label class="mb-1" id="textF">รหัสนักศึกษา</label>
                <h5 class="card-title" id="textL">{{ $alumni->student_code }}</h5>
              </div>
              <div class="mt-1">
                <label class="mb-2" id="textF">ชื่อ-ไทย</label>
                <h5 class="card-title" id="textL">{{ $alumni->student_name_th}}</h5>
              </div>
              <div class="mt-1">
                <label class="mb-2" id="textF">นามสกุล-ไทย</label>
                <h5 class="card-title" id="textL">{{ $alumni->student_surname_th}}</h5>
              </div>
              <div class="mt-1">
                <label class="mb-2" id="textF">ชื่อ-อังกฤษ</label>
                <h5 class="card-title" id="textL">{{ $alumni->student_name_en}}</h5>
              </div>
              <div class="mt-1">
                <label class="mb-2" id="textF">นามสกุล-อังกฤษ</label>
                <h5 class="card-title" id="textL">{{ $alumni->student_surname_en}}</h5>
              </div>
              <div class="mt-2">
                <label class="mb-1" id="textF">สาขาหลักสูตรวิชา</label>
                <h5 class="card-title" id="textL">{{ $alumni->program_name}}</h5>
              </div>
              <div class="mt-2">
                <label class="mb-1" id="textF">คณะ/วิทยาลัย</label>
                <h5 class="card-title" id="textL">{{ $alumni->faculty_name}}</h5>
              </div>
              <div class="mt-2">
                <label class="mb-1" id="textF">ปีที่เริ่มการศึกษา</label>
                <h5 class="" id="textL">{{ $alumni->admit_year }}</h5>
              </div>
              <div class="mt-2">
                <label class="mb-1" id="textF">ปีที่เริ่มการศึกษา</label>
                <h5 class="" id="textL">
                    @if ($alumni->degree == 1)
                    <strong>ปริญญาตรี</strong>
                    @elseif ($alumni->degree == 2)
                    <strong>ปริญญาโท</strong>
                    @elseif ($alumni->degree == 3)
                    <strong>ปริญญาเอก</strong>
                    @endif</h5>
              </div>
            </div>
        </div>
        <a href="{{ route('alumni.indexAlumni') }}" class="btn btn-primary   float-right mb-3">
            กลับ</a>

    </div>


@endsection
