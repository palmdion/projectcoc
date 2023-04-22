@extends('profile.detail')

@section('title', 'Manage Profile')

@section('contentProfile')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

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
    <div id="line"></div>

    {{-- Change Password --}}
    <div class="p-3 ">
        <form action="{{ route('profile.change-password') }}" method="POST">
            @csrf
            <div class="d-flex  align-items-center mb-3">
                <h4 class="text-right">เปลี่ยนรหัสผ่าน</h4>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label class="labels mb-2" for="current_password">รหัสผ่านปัจจุบัน</label>
                    <input type="password" id="current_password" name="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="กรอกรหัสผ่านปัจจุบัน" required>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="labels mb-2" for="new_password">รหัสผ่านใหม่</label>
                    <input type="password" id="new_password" name="new_password"
                        class="form-control @error('new_password') is-invalid @enderror" required
                        placeholder="กรอกรหัสผ่านที่จะเปลี่ยนใหม่">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="labels mb-2" for="new_confirm_password">ยืนยันรหัสผ่าน</label>
                    <input type="password" id="new_confirm_password" name="new_confirm_password"
                        class="form-control @error('new_confirm_password') is-invalid @enderror" required
                        placeholder="ยืนยันรหัสผ่านที่จะเปลี่ยน">
                    @error('new_confirm_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-5 ">
                <button class="btn btn-success profile-button" type="submit">บันทึก</button>
            </div>
        </form>
    </div>
    <div id="line" class=""></div>
    <!-- Edit ระเบียนประวัติ -->
    <div class="p-3 ">
        <form action="{{ route('profile.updateProfile', auth()->user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="">
                    <h4 class="m-0 font-weight-bold">แก้ไขข้อมูลส่วนบุคคล</h4>
                </div>
                <div class="form-group row">
                    <!-- Title Name -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="title_name">คำนำหน้า</label>
                        <input type="text" class="form-control form-control-user" id="title_name"
                            placeholder="กรอรคำนำหน้า" name="title_name"
                            value="{{ old('title_name') ? old('title_name') : auth()->user()->title_name }}">
                        @error('title_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Title Name -->

                    <!-- First Name -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="first_name">ชื่อ</label>
                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="first_name" placeholder="กรอกชื่อ" name="name"
                            value="{{ old('name') ? old('name') : auth()->user()->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END First Name -->

                    <!-- Last Name -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="last_name">นามสกุล</label>
                        <input type="text"
                            class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name"
                            placeholder="นามสกุล" name="last_name"
                            value="{{ old('last_name') ? old('last_name') : auth()->user()->last_name }}">

                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Last Name -->

                    <!-- Image -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="user_image">รูปโปรไฟล์</label>
                        <input type="file"
                            class="form-control form-control-post @error('user_image') is-invalid @enderror" id="user_image"
                            placeholder="user_image" name="user_image" value="{{ auth()->user()->user_image }}">

                        <!-- imageOld -->
                        <input type="hidden" name="image_old" value="{{ auth()->user()->user_image }}">

                    </div>
                    <!-- END Image -->

                    <!-- Email -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="email">อีเมล</label>
                        <input type="email" class=" form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleEmail" placeholder="Email" name="email"
                            value="{{ old('email') ? old('email') : auth()->user()->email }}"disabled>

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Email -->

                    <!-- Birth Date -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="birthdate">วัน เดือน ปีเกิด</label>
                        <input type="date"
                            class="form-control form-control-user @error('birthdate') is-invalid @enderror" id="birthdate"
                            placeholder="วันเดือนปีเกิด" name="birthdate"
                            value="{{ old('birthdate') ? old('birthdate') : auth()->user()->birthdate }}">

                        @error('birthdate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Birth Date -->

                    <!-- Gender -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="gender">เพศ</label>
                        <select class="form-control " name="gender" id="gender">
                            <option>เลือกเพศ</option>
                            <option value="ไม่บอก">ไม่บอก</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Gender -->

                    <!-- Blood Type -->
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="blood_type">หมู่เลือด</label>
                        <input type="text"
                            class="form-control form-control-user @error('blood_type') is-invalid @enderror"
                            id="blood_type" placeholder="หมู่เลือด (เอ หรือ A)" name="blood_type"
                            value="{{ old('blood_type') ? old('blood_type') : auth()->user()->blood_type }}">

                        @error('blood_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Blood Type -->

                    <!-- Bio -->
                    <div class="col-sm-8 mb-3 mt-3 mb-sm-0">
                        <div class="col-sm-12 mb-3 mt-3 ">
                            <div class="form-group">
                                <label class="mb-2" for="user_bio">ชีวประวัติย่อ</label>
                                <textarea class="form-control" style="height:150px" name="user_bio" placeholder="ชีวประวัติ">{{ old('user_bio') ? old('user_bio') : auth()->user()->user_bio }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END Bio -->
                </div>
                <div class="">
                    <h4 class="m-0 font-weight-bold">แก้ไขข้อมูลการติดต่อ</h4>
                </div>
                <div class="form-group row">

                    <!---->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="mobile_number">เบอร์โทร</label>
                        <input class=" form-control form-control-user" type="num" name="mobile_number"
                            placeholder="เบอร์โทร"id="mobile_number"
                            value="{{ old('mobile_number') ? old('mobile_number') : auth()->user()->mobile_number }}">
                    </div>
                    <!---->

                    <!-- Email Backup -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="email_backup">อีเมลติดต่อ</label>
                        <input type="email" class=" form-control form-control-user" id="email_backup"
                            placeholder="อีเมลติดต่อ" name="email_backup"
                            value="{{ old('email_backup') ? old('email_backup') : auth()->user()->email_backup }}">

                    </div>
                    <!-- END Email Backup -->

                    <!-- LinkedIn -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="user_linkedin">LinkedIn</label>
                        <input type="url"
                            class=" form-control form-control-user @error('user_linkedin') is-invalid @enderror"
                            id="user_linkedin" placeholder="URL LinkedIn" name="user_linkedin"
                            value="{{ old('user_linkedin') ? old('user_linkedin') : auth()->user()->user_linkedin }}">

                    </div>
                    <!-- END LinkedIn -->

                    <!-- Facebook -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2" for="user_facebook">Facebook</label>
                        <input type="url" class=" form-control " id="user_facebook" placeholder="URL Facebook"
                            name="user_facebook"
                            value="{{ old('user_facebook') ? old('user_facebook') : auth()->user()->user_facebook }}">
                    </div>
                    <!-- END Facebook -->
                    <br>
                    <br>
                </div>
                <div class="footer mt-2">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">บันทึก</button>

                    <!--<a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('profile.profileFace') }}">กลับ</a>-->
                </div>
        </form>
    </div>

    <div id="line"></div>


    @if (auth()->user()->alumni)

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
                            <th>ปีที่จบ</th>
                            <th>ระดับการศึกษา</th>
                            <th>หลักสูตรวิชา</th>
                            <th>คณะ/วิทยาลัย</th>
                            <th>สถาบันการศึกษา</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="textL">
                        @foreach ($education as $edu)
                            <tr>
                                <td>{{ $edu->education_end }}</td>
                                <td>{{ $edu->depart->degree_fullName }}</td>
                                <td>{{ $edu->depart->depart_fullName }}</td>
                                <td>{{ $edu->faculty }}</td>
                                <td>{{ $edu->university }}</td>
                                <td>
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
        <!-- เพิ่มข้อมูลการศึกษา -->
        <div class="p-3 ">
            <div class="card">
                <div class="card-header">
                    เพิ่มการศึกษา
                </div>
                <div class="card-body">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>ระดับปริญญา</th>
                                <th>หลักสูตร</th>
                                <th>เลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department as $depart)
                                <tr>
                                    <td>{{ $depart->degree_fullName }}</td>
                                    <td>{{ $depart->depart_fullName }}</td>
                                    <td>
                                        <form action="{{ route('profile.addEducation') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">ชื่อคณะ</label>
                                                <input type="text" class="form-control" name="faculty">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">ชื่อมหาวิทยาลัย</label>
                                                <input type="text" class="form-control" name="unverName"
                                                    value="มหาวิทยาลัยขอนแก่น">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">รหัสนักศึกษา</label>
                                                <input type="text" class="form-control" name="studentId">
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
                                            <div style="text-align:center;">
                                                <button class="btn btn-primary mt-2" name="departId"
                                                    value="{{ $depart->id }}">เพิ่ม</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <!-- ยืนยันตัวตนศิษย์เก่า -->
        <div class="p-3 ">
            <h4 id="textF">ข้อมูลการศึกษา</h4>
            <br>
            <div class="card">
                <div class="card-header">
                    ยืนยันตัวตนศิษย์เก่า
                </div>
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
    <br>
    <div id="line"></div>
    <br>
    <div>
        <div class="mb-3">
            <span>
                <h4 id="textF">ข้อมูลอาชีพการทำงาน</h4>
            </span>
        </div>
        <div>
            <table class="table">
                <thead id="textF">
                    <tr>
                        <th>อาชีพ</th>
                        <th>อธิบายรายละเอียด</th>
                        <th>สถานที่ทำงาน</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="textL">
                    @foreach ($work as $workM)
                        <tr>
                            <td>{{ $workM->work_name }}</td>
                            <td>{{ $workM->description }}</td>
                            <td>{{ $workM->company_name }}</td>
                            <td>
                                <a class="btn btn-warning m-2"
                                    href="{{ route('profile.editWork', $workM->id) }}">แก้ไข</a>
                                <form method="POST" action="{{ route('profile.deleteWork', $workM->id) }}">
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
    <div class="p-3 ">
        <div class="card">
            <div class="card-header">
                เพิ่มการทำงาน
            </div>
            <div class="card-body">
                <form action="{{ route('profile.addWork') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="form-group">
                            <label for="category" class="form-label">หมวดหมู่อาชีพ</label>
                            <select class="form-control " name="categories" required>
                                <option>เลือกหมวดหมู่</option>
                                @foreach ($cateWork as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->cateWork_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name_work" class="form-label">ชื่องาน</label>
                            <input class="form-control " type="text" name="name_work" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="name_work" class="form-label">รายละเอียดงาน</label>
                            <input class="form-control " type="text" name="work_detail" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="name_work" class="form-label">ชื่อบริษัท</label>
                            <input class="form-control " type="text" name="name_company" value="" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Page Content
<div class="row">
    <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center  p-3 py-5">
            <img class="rounded-2" width="300px" height="450px"  src="{{asset("")}}">

            {{-- Quick Face
            <div class="card w-100 shadow-md mt-3 d-flex">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <h1 class="h3 mb-0 text-gray-800 m-1">QUICK FACT</h1>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="h5 mb-0 text-gray-800 m-1">Class of:
                            <span class="text-black-50">
                                {{ auth()->user()->class_of ? auth()->user()->class_of->pluck('class_of')->first()
                                : 'N/A' }}</span>
                        </h5>
                    </div>
                    <div>
                        <h5 class="h5 mb-0 text-gray-800 m-1">Academic:
                            <span class="text-black-50">
                                </span>
                        </h5>
                    </div>
                    <div>
                        <h5 class="h5 mb-0 text-gray-800 m-1">Degree:
                            <span class="text-black-50">
                                </span>
                        </h5>
                    </div>
                </div>
            </div>

            {{-- Contact
            <div class="card w-100 shadow-md mt-3 d-flex">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <h1 class="h3 mb-0 text-gray-800 m-1">CONTACT</h1>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="h5 mb-0 text-gray-800 m-1">Email:
                            <span class="text-black-50">
                                </span>
                        </h5>
                    </div>
                    <div>
                        <h5 class="h5 mb-0 text-gray-800 m-1">Social Media:
                            <div>
                                <span class="text-black-50">
                                    Facebook
                                </span>
                                <span class="text-black-50">
                                    LinkedIn
                                </span>
                            </div>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 border-right p-3 py-5">

        {{-- Profile manu
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
              data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
              aria-selected="true">
                Profile Face</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
              data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
              aria-selected="false">
                <a href="{{-- route('profile.detail', $user->id) -">Manage Profile</a></button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
              data-bs-target="#pills-contact" type="button" role="tab"
              aria-controls="pills-contact" aria-selected="false">
                My Posts</button>
            </li>
            @hasrole('Staff')
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-event-tab" data-bs-toggle="pill"
                data-bs-target="#pills-event" type="button" role="tab"
                aria-controls="pills-event" aria-selected="false">
                    Event</button>
              </li>
            @endhasrole
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
            aria-labelledby="pills-home-tab" tabindex="0">
                <div class=""><span>คำนำหน้า-ชื่อ-สกุล</span></div>
                <div class="border-bottom"><span>Highlight</span></div>
                <div class=""><span>Category Work</span></div>
                <div class=" "><span>Work Position</span></div>
                <div class=" "><span>Decription Work</span></div>
                <div class=" "><span>bio</span></div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
            aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="container-fluid">

                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab" tabindex="0">...</div>
        </div>
</div> --}}



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
