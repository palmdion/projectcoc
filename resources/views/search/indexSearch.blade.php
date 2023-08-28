@extends('welcome')

@section('title', 'Search Alumni')
@section('mainContent')
<div>
    <div class=" container-fluid ">
        <nav aria-label="breadcrumb" id="textL">
            <ol class="breadcrumb">
                <a class="breadcrumb-item nav-link" href="{{ route('home') }}">หน้าหลัก</a>
                <li class="breadcrumb-item active" aria-current="page">การค้นหาศิษย์เก่า</li>
            </ol>
        </nav>
    </div>
    <div class=" container ">
        <h1>Search Alumni</h1>
        <form  action="{{ route('search.indexSearch') }}" method="GET">
            @csrf
            <div class="row">
                {{-- <div class="col">
                    <label class="m-2" id="textF" for="">หลักสูตร:</label>
                    <select id="inputState" name="keyword_edu" class="form-select">
                        <option selected>ทั้งหมด</option>
                        <option >วิทยาการคอมพิวเตอร์</option>
                        <option >IT</option>
                        <option >GIS</option>
                    </select>
                </div>
                <div class="col">
                    <label class="m-2"  id="textF" for="">ระดับปริญญา:</label>
                    <select type="search" id="inputState" name="keyword_degree" class="form-select">
                        <option selected>ทั้งหมด</option>
                        <option >ปริญญาตรี</option>
                        <option >ปริญญาโท</option>
                        <option >ปริญญาเอก</option>
                    </select>
                </div> --}}
            <div>
                <div class="mt-3">
                    <label class="m-2" id="textF" for="">ค้นหา:</label>
                        <input type="search" class="form-control" name="keyword" placeholder="ระบุการค้นหา ชื่อ นามสกุล รหัสนักษาศึกษา" >
                        <div class="mt-4">
                            <button id="reputayionBtn"
                                type="submit"
                                class="btn fw-bolder"
                                style="padding-right:50px;
                                    padding-left:50px;">ค้นหา</button>
                        </div>
                </div>
            </div>
        </form>
            <!--แสดงรายชื่อ-->
                @if (count($searchResult) > 0)
                    <div class="row row-cols-1 row-cols-md-2">
                        @foreach ($searchResult as $search )
                        <div class="col-md-6 g-3">
                                <div class="col-md card " style="max-width: 600px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ asset('admin/image/user2.png') }}" class="img-fluid w-100" width="225px" height="300px"alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                <h3 class="" id="textF">{{ $search->student_name_th}} {{ $search->student_surname_th}}</h3>
                                                <h6 class="" id="textF">{{ $search->student_code }}</h6>
                                                <h6 class="" id="textF">ระดับการศึกษา:
                                                    @if ($search->degree == 1)
                                                        {{"ปริญญาตรี"}}
                                                    @elseif ($search->degree == 2)
                                                        {{"ปริญญาโท"}}
                                                    @elseif ($search->degree == 3)
                                                        {{"ปริญญาเอก"}}
                                                    @endif
                                                </h6>
                                                <h6 class="" id="textF">หลักสูตร: {{ $search->program_name }} </h6>
                                                <h6 class="" id="textF">ปีการศึกษา: {{ $search->admit_year }} </h6>
                                                <h6 class="" id="textF">อีเมล: {{ $search->email_backup }}</h6>
                                                <div class=" text-uppercase"><span id="textF">ช่องทางการติดต่อ:</span></div>
                                                <div class="p-2 ">
                                                    <a href="{{ $search->user_facebook }}" class=" h-100"><i
                                                            class="fa-brands fa-facebook fa-2xl"></i></a>
                                                    <a href="{{ $search->user_linkedin }}" class=" h-100"><i
                                                            class="fa-brands fa-linkedin fa-2xl"></i></a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        @endforeach
                </div>
                @else
                    <div class="card text-center m-2 shadow-sm">
                        <div class="card-body">
                            <strong>ไม่พบข้อมูล</strong>
                        </div>
                    </div>
                @endif
        </div>
        </div>
    </div>
    <br>
</div>
@endsection
