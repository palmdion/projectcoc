@extends('welcome')

@section('title', 'Profile')

@section('mainContent')
<div>
        <!-- Page Heading -->
        <div class="">
            {{-- <div class="container-fluid   mb-4">
                <h1 id="textL" class="h3 mb-0">โปรไฟล์ผู้ใช้</h1>
            </div>
            <div id="line"></div> --}}
        </div>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center  p-3 py-5">
                    <div class="card">
                        <img class="rounded-2  " width="300px" height="450px" src="{{ asset('admin/image/user2.png')  }}  ">
                    </div>
                    {{-- <img class="rounded-2" width="300px" height="450px" src="{{ asset('admin/image/user.png')  }} {{ asset(Auth::user()->user_image) }} "> --}}
                    <!-- Contact -->
                    {{-- <div class="card w-100 shadow-md mt-3 d-flex">
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <h1 class="h3 mb-0 m-1 text-uppercase" id="textF">CONTACT</h1>
                        </div>
                        <div class="card-body">
                            <div>
                                <span class="h5 mb-0 m-1 text-uppercase" id="textF">Email:
                                </span>
                                <span id="textL" class="h5 p-2">
                                    {{ auth()->user()->email_backup }}</span>
                            </div>
                            <div>
                                <h5 class="h5 mb-0  m-1 text-uppercase" id="textF">Social Media:
                                    <div class="p-2 mt-3 ">
                                        <a href="{{ auth()->user()->user_facebook }}" class=" h-100"><i class="fa-brands fa-facebook fa-2xl"></i></a>
                                        <a href="{{ auth()->user()->user_linkedin }}" class=" h-100"><i class="fa-brands fa-linkedin fa-2xl"></i></a>
                                    </div>
                                </h5>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-9 border-right p-3 py-4 ">
                <div class="mb-4">
                    <a  class="btn  btn-outline-primary  " href="{{ route('profile.profileFace') }}">โปรไฟล์ของฉัน</a>
                    <a  class="btn  btn-outline-primary " href="{{ route('profile.myEducation') }}">การศึกษา</a>
                    <a class="btn  btn-outline-primary " href="{{ route('profile.myWork') }}">อาชีพการทำงาน</a>
                    @if (auth()->user()->alumni == 1 || auth()->user()->role_id == 1)
                        <a  class="btn  btn-outline-primary" href="{{ route('profile.myPosts') }}">ข่าวสาร</a>
                    @endif
                    @if (auth()->user()->alumni == 1 || auth()->user()->role_id == 1)
                        <a  class="btn  btn-outline-primary" href="{{ route('profile.myEvent') }}">กิจกรรม</a>
                    @endif
                </div>

            <br>
                <main>
                    <div>
                        @yield('contentProfile')
                    </div>
                </main>
    </div>
@endsection
