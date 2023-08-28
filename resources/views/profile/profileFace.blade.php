@extends('profile.detail')

@section('title', 'Profile Face')

@section('contentProfile')
    <div class="container-fluid ">
        <div id="line"></div>
        <div class=" d-flex ">
            <a class="btn btn-primary" href="{{ route('profile.manageProfile') }}">แก้ไขโปรไฟล์</a>
        </div>
        <br>
        <div>
            <div >
                <label class="mb-2">
                    <h3 class="text-uppercase " id="textF">{{ auth()->user()->full_name }}</h3>
                </label>
            </div>
            <div class="row">
                <span class="col-4 p-2" id="textF">อีเมล:</span>
                <span class="col p-2" id="textL">{{ auth()->user()->email }}</span>
            </div>
            <div class="row">
                <span class="col-4 p-2" id="textF">สถานภาพ:</span>
                <span class="col p-2 ">
                    @if (auth()->user()->alumni == 1)
                        <h6 id="textL">สมาชิกศิษย์เก่า</h6>
                    @elseif (auth()->user()->role_id == 3)
                        <h6 id="textL">สมาชิกที่ได้รับอนุญาต</h6>
                    @elseif (auth()->user()->role_id == 1)
                        <h6 id="textL">ผู้ดูแลระบบ</h6>
                    @else
                        <h6 id="textL">สมาชิกทั่วไป</h6>
                    @endif
                </span>
            </div>
            <div class="row" >
                <span class="col-4 p-2" id="textF">เกี่ยวกับฉัน:</span>
                <label class="col p-2">
                    <p class=" font-monospace"id="textL" >{{ auth()->user()->user_bio }}</p>
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
                        <div class="col-md-8 p-2"><a class="nav-link " id="textL">{{ auth()->user()->email_backup }}</a></div>
                    </div>
                    <div class=" row  row-cols-1 row-cols-md-2 g-2  ">
                        <div class="col-md-4 p-2  text-uppercase"><span id="textF">สื่อโซเชียว:</span></div>
                        <div class="col-md-8 p-2 no-padding  ">
                            <a href="{{ auth()->user()->user_facebook }}" class=" h-100"><i
                                    class="fa-brands fa-facebook fa-3x "></i></a>
                            <a href="{{ auth()->user()->user_linkedin }}" class=" h-100 "><i
                                    class="fa-brands fa-linkedin fa-3x"></i></a>
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
                                <th>ระดับการศึกษา</th>
                                <th>หลักสูตรวิชา</th>
                                <th>คณะ/วิทยาลัย</th>
                                <th>รหัสนักศึกษา</th>
                                <th>สถาบันการศึกษา</th>
                                <th>ปีที่เริ่ม</th>
                                <th>ปีที่จบ</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <div>
                            <div id="textF">อาชีพ: <span id="textL">{{ $workU->work_name }}</span></div>
                            <div id="textF">สถานที่ทำงาน: <span id="textL">{!! $workU->company_name !!}</span></div>
                            <div id="textF">อธิบายรายละเอียด: <span id="textL">{!! $workU->description !!}</span></div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
