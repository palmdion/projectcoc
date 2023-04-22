@extends('profile.detail')

@section('title', 'Profile Face')

@section('contentProfile')
    <div class="container-fluid ">
        <div class="mb-4">
            <a class="btn btn-outline-primary active " href="{{ route('profile.profileFace') }}">โปรไฟล์ของฉัน</a>
            <a class="btn btn-outline-primary" href="{{ route('profile.manageProfile') }}">แก้ไขโปรไฟล์</a>
            @if (auth()->user()->alumni == 1)
                <a class="btn btn-outline-primary" href="{{ route('profile.myPosts') }}">ข่าวสารของฉัน</a>
            @endif
            @hasanyrole(['Staff', 'Admin'])
                <a class="btn btn-outline-primary" href="{{ route('profile.myEvent') }}">กิจกรรมของฉัน</a>
            @endhasanyrole
        </div>
        <div>
            <div class="mb-2">
                <label>
                    <h3 class="text-uppercase " id="textF">{{ auth()->user()->full_name }}</h3>
                </label>
            </div>
            <div class="row">
                <span class="col-2 p-2" id="textF">อีเมล</span>
                <span class="col p-2" id="textL">{{ auth()->user()->email }}</span>
            </div>
            <div class="row">
                <span class="col-2 p-2" id="textF">สถานภาพ:</span>
                <span class="col p-2 ">
                    @if (auth()->user()->alumni == 0)
                        <h6 id="textL">ผู้ใช้งานทั่วไป</h6>
                    @else
                        <h6 id="textL">ศิษย์เก่า</h6>
                    @endif
                </span>
            </div>
            <br>
            <div class="mt-2">
                <label>
                    <p class="font-monospace">{{ auth()->user()->user_bio }}</p>
                </label>
            </div>
            <br>
            <div class="progress" role="progressbar" aria-label="1px high" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100" style="height: 1px">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            <br>
            <div>
                <div class="mb-2">
                    <span>
                        <h4 id="textF">ข้อมูลส่วนบุคคล</h4>
                    </span>
                </div>
                <div>
                    <div class="row row-cols-1 row-cols-md-2 g-2 ">
                        <div class="col-md-4  p-2 " id="bg"><span id="textF">ชื่อ:</span></div>
                        <div class="col-md-8  p-2 text-uppercase" id="bg"><span
                                id="textL">{{ auth()->user()->full_name }}</span></div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-2  ">
                        <div class="col-md-4 p-2"><span id="textF">วันเกิด:</span></div>
                        <div class="col-md-8 p-2"><span id="textL">{{ auth()->user()->birthdate }}</span></div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-2  ">
                        <div class="col-md-4 p-2"><span id="textF">เพศ:</span></div>
                        <div class="col-md-8 p-2"><span id="textL">{{ auth()->user()->gender }}</span></div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-2  ">
                        <div class="col-md-4 p-2"><span id="textF">หมู่เลือด:</span></div>
                        <div class="col-md-8 p-2"><span id="textL">{{ auth()->user()->blood_type }}</span></div>
                    </div>

                </div>
            </div>
            <br>
            <div class="progress" role="progressbar" aria-label="1px high" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100" style="height: 1px">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            <br>
            <div>
                <div class="mb-2">
                    <span>
                        <h4 id="textF">ข้อมูลการติดต่อ</h4>
                    </span>
                </div>
                <div>
                    <div class="row row-cols-1 row-cols-md-2 g-2  ">
                        <div class="col-md-4 p-2"><span id="textF">อีเมลติดต่อ:</span></div>
                        <a class="nav-link " id="textL">{{ auth()->user()->email_backup }}</a>
                    </div>
                    <div class="  ">
                        <div class="col-md-4 p-2 text-uppercase"><span id="textF">Social Media:</span></div>
                        <div class="p-2 ">
                            <a href="{{ auth()->user()->user_facebook }}" class=" h-100"><i class="fa-brands fa-facebook fa-2xl"></i></a>
                            <a href="{{ auth()->user()->user_linkedin }}" class=" h-100"><i class="fa-brands fa-linkedin fa-2xl"></i></a>
                        </div>
                    </div>
                </div>
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
                                <th>ปีที่จบ</th>
                                <th>ระดับการศึกษา</th>
                                <th>หลักสูตรวิชา</th>
                                <th>คณะ/วิทยาลัย</th>
                                <th>สถาบันการศึกษา</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div>
            <div class="mb-3">
                <span>
                    <h4 id="textF">ข้อมูลการทำงาน</h4>
                </span>
            </div>
            <div>
                @foreach ($work as $workU)
                    <div >
                        <div id="textF">อาชีพ: <span id="textL">{{ $workU->work_name }}</span></div>
                        <div id="textF">อธิบาย: <span id="textL">{{ $workU->description }}</span></div>
                        <div id="textF">สถานที่ทำงาน: <span id="textL">{{ $workU->company_name }}</span></div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
