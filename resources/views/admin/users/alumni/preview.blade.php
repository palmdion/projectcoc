@extends('admin.index')

@section('title', 'Users List')

@section('content')

    <div class="container-fluid" id="users" role="tabpanel" aria-labelledby="users" tabindex="0">
        <!-- Page Heading -->
        <div class="d-sm-flex justify-content-between  mb-4 p-4">
            <h1 class="h3 mb-0 text-gray-800 ">เอกสารข้อมูล</h1>
        </div>
        <!-- Alert Messages -->
        @include('admin.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลศิษย์เก่าในเอกสารข้อมุล</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('alumni.addAlumni') }}">
                    @csrf
                    @method('POST')
                    <div style="text-align: center">
                        <select class="form-control" name="education" id="education">
                            <option value="1">ปริญญาตรี</option>
                            <option value="2">ปริญญาโท</option>
                            <option value="3">ปริญญาเอก</option>
                        </select>
                        <button class="btn btn-success m-2" type="submit">
                            บันทึก
                        </button>
                        <a class="btn btn-warning" href="{{ route('users.importAlumni') }}">ย้อนกลับ</a>
                </form>
            </div>
            <div class=" table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="">รหัสนักศึกษา</th>
                            <th width="">ชื่อ</th>
                            <th width="">สกุล</th>
                            <th width="">ชื่อ อังกฤษ</th>
                            <th width="">สกุล อังกฤษ</th>
                            <th width="">หลักสูตรวิชา</th>
                            <th width="">คณะ/วิทยาลัย</th>
                            <th width="">ปีการศึกษา</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($alumnis as $alumni)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $alumni->student_code }}</td>
                                    <td>{{ $alumni->student_name_th }}</td>
                                    <td>{{ $alumni->student_surname_th }}</td>
                                    <td>{{ $alumni->student_name_en }}</td>
                                    <td>{{ $alumni->student_surname_en }}</td>
                                    <td>{{ $alumni->program_name }}</td>
                                    <td>{{ $alumni->faculty_name }}</td>
                                    <td>{{ $alumni->admit_year }}</td>
                                    <td style="display: flex">
                                        <form method="POST" action="{{ route('alumni.deleteAlumniPre', $alumni->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-2" type="submit">
                                                ลบ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{-- $alumnis->links('pagination::bootstrap-5') --}}
            </div>
            <br>
        </div>
    </div>
    </div>

@endsection

@section('scripts')

@endsection
