@extends('profile.detail')

@section('title', 'Manage Education')

@section('contentProfile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <!-- Alert Messages -->
    @include('admin.alert')
    <div class=" ">
        <div><a class="btn btn-secondary  " href="{{ route('profile.myEducation') }}">กลับ</a></div>
    <br>
    <!-- เพิ่มข้อมูลการศึกษา -->
    <div class=" ">
        <div class=" ">
            <div class="card">
                <div class="card-header">
                    เพิ่มการศึกษา
                </div>
                <div class="card-body">
                    <form  action="{{ route('profile.addEducation') }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="form-group">
                                <label for=" departName"  class="form-label">ชื่อสาขา/หลักสูตร</label>
                                <input type="text" class="form-control" name="departName" required>
                            </div>
                            <div class="form-group">
                                <label for="name_work" class="form-label">ชื่อคณะ/วิทยาลัย </label>
                                <input type="text" class="form-control" name="faculty" required>
                            </div>
                            <div class="form-group">
                                <label for="degreeName"  class="form-label">ระดับการศึกษา</label>
                                <input type="text" class="form-control" name="degreeName" required>
                            </div>
                            <div class="form-group">
                                <label for="name_work" class="form-label">รหัสนักศึกษา</label>
                                <input type="text" class="form-control" name="studentId" required>
                            </div>
                            <div class="form-group">
                                <label for="name_work" class="form-label">ชื่อมหาวิทยาลัย</label>
                                <input type="text" class="form-control" name="unverName"
                                                value="มหาวิทยาลัยขอนแก่น" required>
                            </div>
                            <div class="form-group">
                                <label for="lean_start">เริ่มศึกษา</label>
                                <input type="number" class="form-control" name="start_lean"
                                    min="2400" max="2999" step="1" value="2566" />
                            </div>

                            <div class="form-group">
                                <label for="lean_end">จบการศึกษา</label>
                                <input type="number" class="form-control" name="end_lean"
                                    min="2400" max="2999" step="1" value="2566" />
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">ยืนยัน</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
