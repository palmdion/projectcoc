@extends('welcome');

@section('title', 'Recognition')
@section('mainContent')

<div class="container-fluid">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <a class="breadcrumb-item nav-link" href="{{ route('home') }}">Home</a>
              <a class="breadcrumb-item nav-link" href="{{ route('recognition.showAllUser') }}">Recognition All</a>
              <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 200px;">{{  $user->full_name }}</li>
            </ol>
        </nav>
    </div>
    <div class="container ">
        <div class="row row-cols-1 row-cols-md-1 g-3 mt-3">
            <div class="col-md-4">
                <div>
                    <div class="card-img">
                        <img class="rounded-2 " width="300px" height="450px"   src="{{asset($user->user_image)}}">

                        <!-- Quick Face -->
                            <div class="card shadow-md mt-3 d-flex w-75 w-md-75">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <h1 class="h3 mb-0 text-gray-800 m-1">QUICK FACT</h1>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <h5 class="h5 mb-0 text-gray-800 m-1">Class of:
                                            <span class="text-black-50">
                                                {{ $user->education
                                                    ? $user->education->pluck('education_start')->first()
                                                    : 'N/A' }}</span>
                                        </h5>
                                    </div>
                                    <div>
                                        <h5 class="h5 mb-0 text-gray-800 m-1">Academic:
                                            <span class="text-black-50">
                                                {{  $user->education
                                                    ? $user->education->pluck('depart_id')->first()
                                                    : 'N/A'  }}</span>
                                        </h5>
                                    </div>
                                    <div>
                                        <h5 class="h5 mb-0 text-gray-800 m-1">Degree:
                                            <span class="text-black-50">
                                                {{  $user->department
                                                    ? $user->department->pluck('degreeName_full')->first()
                                                    : 'N/A'  }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        <!-- Contact -->
                        <div class="card  shadow-md mt-3 d-flex w-75 w-md-75">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <h1 class="h3 mb-0 text-gray-800 m-1">CONTACT</h1>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h5 class="h5 mb-0 text-gray-800 m-1">Email:
                                        <span class="text-black-50">
                                            {{$user->email_backup }}</span>
                                    </h5>
                                </div>
                                <div>
                                    <h5 class="h5 mb-0 text-gray-800 m-1">Social Media:
                                        <div>
                                            <span class="text-black-50">
                                                Facebook {{$user->user_facebook }}
                                            </span>
                                            <span class="text-black-50">
                                                LinkedIn {{$user->user_linkedin }}
                                            </span>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2>{{ $user->title_name }}{{ $user->name }}  {{ $user->last_name }}</h2>
                <h4>{{ $user->user_bio}}</h4>
                <h4><label for="">สถานที่ทำงาน</label></h4>
                <h4>{{ $user->work
                    ? $user->work->pluck('company_name')->first()
                    : 'N/A' }}
                </h4>
                <h4>{{ $user->work
                    ? $user->work->pluck('description')->first()
                    : 'N/A' }}
                </h4>
                <h4>ประวัติการศึกษา</h4>
                
            </div>
        </div>
    </div>
</div>
<br>
@endsection
