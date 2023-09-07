@extends('admin.index')

@section('title', 'Alumni List')

@section('content')

<div class="container-fluid" id="users" role="tabpanel" aria-labelledby="users" tabindex="0">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between p-4">
        <h1 class="h3 mb-0 text-gray-800 ">รายชื่อศิษย์เก่าทั้งหมด</h1>
        <div class=" ">

        </div>
    </div>
    <div class="d-sm-flex justify-content-end  p-4">
        {{-- <div  class="">
            <a href="{{ route('users.index') }}" class="btn  btn-secondary ">
                กลับ
           </a>
        </div> --}}
        <div class="">
            <a href="{{ route('users.importAlumni') }}" class="btn btn-success">
                 นำเข้าข้อมูลศิษย์เก่า
            </a>
        </div>
    </div>
      <!-- Alert Messages -->
      @include('admin.alert')

    <!-- DataTales Example -->
    <div class="card shadow py-3">
        <div class="m-2">
            <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลศิษย์เก่า</h6>
        </div>
        <!-- ค้นหาข้อมูล-->
        <form  action="{{ route('alumni.searchAlumni') }}" method="GET">
            @csrf
            <div class="d-flex m-2" >
                <div class="d-flex ">
                    <form class="">
                        <input type="search" class="form-control me-2" name="keywordAlum" placeholder="Search" >
                        <button class="btn btn-outline-info" type="submit">ค้นหา</button>
                    </form>
                </div>
            </div>
        </form>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">รหัสนักศึกษา</th>
                                <th width="">ชื่อ</th>
                                <th width="">สกุล</th>
                                <th width="">ชื่อ อังกฤษ</th>
                                <th width="">สกุล อังกฤษ</th>
                                <th width="">หลักสูตรวิชา</th>
                                <th width="">คณะ/วิทยาลัย</th>
                                <th width="">ปีการศึกษา</th>
                                <th width="">ระดับการศึกษา</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnis as $alumni)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $alumni->student_code }}</td>
                                    <td>{{ $alumni->student_name_th }}</td>
                                    <td>{{ $alumni->student_surname_th }}</td>
                                    <td>{{ $alumni->student_name_en }}</td>
                                    <td>{{ $alumni->student_surname_en}}</td>
                                    <td>{{ $alumni->program_name }}</td>
                                    <td>{{ $alumni->faculty_name }}</td>
                                    <td>{{ $alumni->admit_year }}</td>
                                    <td>@if ($alumni->degree == 1)
                                        <strong>ปริญญาตรี</strong>
                                        @elseif ($alumni->degree == 2)
                                        <strong>ปริญญาโท</strong>
                                        @elseif ($alumni->degree == 3)
                                        <strong>ปริญญาเอก</strong>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        <a href="{{ route('alumni.showAlumni',['alumni' => $alumni->id]) }}"
                                            class="btn btn-primary   m-2">
                                            แสดง
                                        </a>
                                        <a href="{{ route('alumni.editAlumni',['alumni' => $alumni->id]) }}"
                                            class="btn btn-warning  m-2">
                                            แก้ไข
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $alumnis->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
