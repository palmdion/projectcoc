@extends('profile.detail')

@section('title', 'Education')

@section('contentProfile')

    <!-- Alert Messages -->
    @include('admin.alert')
    @if (auth()->user()->alumni)
    <div class="d-flex ">
        <div><a class="btn btn-primary " href="{{ route('profile.editEducation') }}">เพิ่มการศึกษา</a></div>
    </div>
    <br>
    <div>
        <div class="mb-3">
            <span>
                <h4 id="textF">ข้อมูลการศึกษา</h4>
            </span>
        </div>
        <div>
            <table class="table">
                <thead id="textF">
                    <tr>
                        <th>ระดับการศึกษา</th>
                        <th>หลักสูตรวิชา</th>
                        <th>คณะ/วิทยาลัย</th>
                        <th>รหัสนักศึกษา</th>
                        <th>สถาบันการศึกษา</th>
                        <th>ปีที่เริ่ม</th>
                        <th>ปีที่จบ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="textL">
                    @foreach ($education as $edu)
                        <tr>
                            <td>{{ $edu->degreeName }}</td>
                            <td>{{ $edu->departName }}</td>
                            <td>{{ $edu->faculty }}</td>
                            <td>{{ $edu->student_number }}</td>
                            <td>{{ $edu->university }}</td>
                            <td>{{ $edu->education_start }}</td>
                            <td>{{ $edu->education_end }}</td>
                            <td  class="d-flex ">
                                <a class="btn btn-warning m-2"
                                    href="{{ route('profile.editEdu', $edu->id) }}">แก้ไข</a>
                                <form method="POST" action="{{ route('profile.deleteEdu', $edu->id) }}">
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

        </div>
    </div>

    @else
        <!-- ยืนยันตัวตนศิษย์เก่า -->
        <div class="p-3 ">
            <h4 id="textF">ยืนยันตัวตนศิษย์เก่า</h4>
            <br>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.verifyAlumni') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">ชื่อ</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="name_student" name="name_student" class="form-control"
                                    value="">
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">นามสกุล</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="surname_student" name="surname_student" class="form-control "
                                    value="">
                            </div>
                            <br>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary  mb-3">ยืนยัน</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection


