@extends('profile.detail')

@section('title', 'Edit Education Profile')

@section('contentProfile')

    <div class="container-fluid">

        <!-- Alert Messages -->
        @include('admin.alert')
        <div class="mb-4">
            <a class="btn btn-outline-primary  " href="{{ route('profile.profileFace') }}">โปรไฟล์ของฉัน</a>
            <a class="btn btn-outline-primary active" href="{{ route('profile.manageProfile') }}">แก้ไขโปรไฟล์</a>
            @if (auth()->user()->alumni == 1)
                <a class="btn btn-outline-primary" href="{{ route('profile.myPosts') }}">ข่าวสารของฉัน</a>
            @endif
            @hasanyrole(['Staff', 'Admin'])
                <a class="btn btn-outline-primary" href="{{ route('profile.myEvent') }}">กิจกรรมของฉัน</a>
            @endhasanyrole
        </div>
        <br>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขประวัติการศึกษา</h1>
        </div>
        <div id="line"></div>
        <br>
        <a class="btn btn-secondary  float-right" href="{{ route('profile.manageProfile') }}">กลับ</a>
        <br>
        <br>
        <!-- ข้อมูลอีเว้นท์-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">การศึกษา</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('profile.updateEdu', $edu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row card-body">
                        <!-- depart -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ระดับการศึกษา (หลักสูตรวิชา)</label>

                                <input class="form-control "  id="depart_id" name="depart_id" hidden  value="{{$edu->depart_id}}">
                                <input class="form-control "  id="depart_id" value="{{$edu->depart->degree_fullName}}  ({{$edu->depart->depart_fullName}})" disabled>
                        </div>
                        <!-- depart -->
                        <!-- depart -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">รหัสนักศึกษา</label>
                            <input type="text"
                                class="form-control "
                                id="student_number" placeholder="Title Name" name="student_number"
                                value="{{ $edu->student_number  }}">
                        </div>
                        <!-- depart -->

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ปีที่เริ่ม</label>
                            <input type="number"
                                class="form-control form-control-post "
                                id="education_start" placeholder="Title Name" name="education_start"
                                value="{{ $edu->education_start }}">
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ปีที่จบ</label>
                            <input type="number"
                                class="form-control form-control-post "
                                id="education_end" placeholder="Title Name" name="education_end"
                                value="{{ $edu->education_end }}">
                        </div>

                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">คณะ/วิทยาลัย</label>
                            <input type="text"
                                class="form-control form-control-post "
                                id="faculty" placeholder="Title Name" name="faculty"
                                value="{{ $edu->faculty }}">
                        </div>

                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">สถาบันการศึกษา</label>
                            <input type="text"
                                class="form-control form-control-post"
                                id="university" placeholder="Title Name" name="university"
                                value="{{ $edu->university }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
