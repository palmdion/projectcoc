@extends('welcome');

@section('title', 'Home page')
@section('mainContent')
<div>
    <div class="mt-1">
        <main>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner" >
                  <div class="carousel-item active">
                    <img src="{{ asset('admin/image/COC.png') }}" class="d-block w-100" height="600px"  alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('admin/image/COC1.png') }}" class="d-block w-100" height="600px"  alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('admin/image/COC2.png') }}" class="d-block w-100" height="600px"  alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </main>
        <br><br><br>
        <!--<section >
            <div class="container">
                <br>
                <div class="row row-cols-1 row-cols-md-2 g-5">
                    <div class="col-md-6">
                        <div  class="card shadow-lg">
                            <img src="{{ asset('admin1/image/COC1.png') }}" height="300px" class="card-img " alt="...">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div>
                            <div >
                                <h4 style="color: #0F75BC;">เกี่ยวกับเรา</h4>
                            </div>
                            <div><h2 style="color: #0F75BC;">สมาคมศิษย์เก่าวิทยาลัยการคอมพิวเตอร์</h2></div>
                            <br>
                            <div>
                                <div><a class="btn btn-outline-primary" href="{{ url('/404') }}">เกี่ยวกับเรา</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <br><br><br>
        <section id="postBody" class="container">
            <div>
                <div id="postTitle" class="mb-4 mt-4">
                    <div class="textHeadTitle">ข่าวสารประชาสัมพันธ์</div>
                    <div class="textBodyTitle">การประชาสัมพันธ์ข่าวสารที่เกี่ยวข้องกับศิษย์เก่าวิทยาลัยการคอมพิวเตอร์</div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @forelse($posts as $post)
                        <div class="col" >
                            <div  class="card h-100 shadow">
                                <a href="#"><img src="{{asset($post->post_image)}}" class="card-img-top" alt="" height="250px"></a>
                                <div class="card-body">
                                    <h5 style="color: #0F75BC;" class="card-title">{{ $post->post_title }}</h5>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <div>
                                        <a style="color: #0F75BC" class="nav-link stretched-link" id="textMore" href="{{ route('postHome.showPost',$post->id ) }}">อ่านเพิ่มเติ่ม</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12 col-md-12">
                            <div class="card h-100 shadow-lg">
                                <div class="single-post post-style-1 p-2 text-center">
                                   <strong>No Posts <br> รีบไปสร้างข่าวให้หน่อย </strong>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center mt-4">
                <a id="reputayionBtn" href="{{ url('postHome/mainPost') }}" class="btn ">ข่าวสารทั้งหมด</a>
            </div>
        </section>
        <br><br><br>
        {{--<section id="reputationBody">
            <div class="">
                <div id="reputationTitle" class="mb-4">
                    <div class="mt-3" id="lineTop"></div>
                    <div class="textHeader">ศิษย์เก่าดีเด่น</div>
                    <div class="container" id="lineLow"></div>
                </div>
                <br>
                <div class="container">
                    <div class="row row-cols-2 row-cols-md-4 g-4">
                        @forelse($users as $user)
                            <div class="col">
                                <div id="reputationCard" class="rounded-0">
                                <img id="img" src="{{ asset($user->user_image) }}" height="400px" class="card-img-top"  alt="...">
                                <div class="card ">
                                    <div id="reputationCardContent">
                                        <span id="reputationTextTitle" class="card-title">{{ $user->title_name }}</span>
                                        <span id="reputationTextName" class="card-title">{{ $user->name }} {{ $user->last_name }}</span>
                                        <p id="reputationTextRepu" class="card-text">{{  $user->work
                                            ? $user->work->pluck('company_name')->first()
                                            : 'N/A'}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-lg-12 col-md-12">
                                    <div class="card h-100 shadow">
                                        <div class=" p-2 text-center">
                                            <strong>No Alumni </strong>
                                        </div>
                                    </div>
                                </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <br>

            <div class="d-flex justify-content-center ">
                <a id="reputayionBtn" href="{{ route('recognition.showAllUser') }}" class="btn ">ศิษย์เก่าดีเด่นทั้งหมด</a>
            </div>
            <br>
        </section>--}}
        <br><br><br>
        <section id="event">
                <div class="container ">
                    <div class="container">
                        <div class=" align-item-center" >
                            <span  id="eventTitle">กิจกรรมที่น่าสนใจ </span>
                            <span><div class="md-2" id="lineEvent"></div></span>
                        </div>
                        <br>
                        <div class="row row-cols-1 row-cols-md-2 g-5">
                            @forelse($events as $eventList)
                                        <div class="col-md-5" >
                                            <div  class="card h-100 shadow bg-white">
                                                <a href="#"><img src="{{asset($eventList->event_image_cover)}}" class="card-img-top" alt="" height="250px"></a>
                                                <div class="card-body">
                                                    <h5 style="color: #0F75BC;" class="card-title fw-semibold">{{ $eventList->event_title }}</h5>
                                                    <p class="card-text">{{ $eventList->description }}</p>
                                                    <div>
                                                        <div style="color: #0F75BC" class=" card-text"><h6>วันที่เริ่ม : {{ $eventList->event_start }}</h6><h6>วันที่สิ้นสุด : {{ $eventList->event_end }}</h6></div>
                                                    </div>
                                                    <div>
                                                        <a style="color: #0F75BC" class="nav-link stretched-link" id="textMore" href="{{route('eventHome.showEvent',$eventList->id ) }}">อ่านเพิ่มเติ่ม</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card h-100 shadow-lg">
                                                <div class="single-post post-style-1 p-2 text-center">
                                                <strong>No Event <br> รีบไปสร้างกิจกรรมให้หน่อย </strong>
                                                </div>
                                            </div>
                                        </div>
                            @endforelse
                            <div class="col-md-7">
                                @forelse($event as $eventHlist)
                                        <div class="bg-white shadow-sm " >
                                            <div class=" nav-link">
                                                <a style="color: #0F75BC" class="nav-link tretched-link " href= "{{ route('eventHome.showEvent',$eventHlist->id) }}">
                                                    <span class="fs-5 fw-semibold text-truncate mb-2">{{ $eventHlist->event_title }}</span>
                                                    <div  class="fw-semibold"><h6>วันที่เริ่ม: {{ $eventHlist->event_start }} </h6><h6>วันที่สิ้นสุด:{{ $eventHlist->event_end }}</h6> </div>
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                        @empty
                                        <div class="col-md-7">
                                            <div class="card shadow-lg">
                                                <div class="single-post post-style-1 p-2">
                                                <strong>No Event <br> รีบไปสร้างกิจกรรมให้หน่อย</strong>
                                                </div>
                                            </div>
                                        </div>
                                @endforelse
                                    <div class="d-flex  mt-4">
                                        <a id="reputayionBtn" href="{{ url('eventHome/mainEvent') }}" class="btn ">กิจกรรมทั้งหมด</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <br><br><br>
        <!--<section >
            <div class="container ">
                <div class="container">
                    <br>
                    <div class="row row-cols-1 row-cols-md-2 g-5">
                        <div class="col-md-6">
                            <div >
                                <div >
                                    <h1>คู่มือการใช้งาน</h1>
                                </div>

                                <br>
                                <div>
                                    <div><a class="btn btn-outline-primary" href="{{ url('/404') }}">คู่มือเว็บไซต์</a></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6  ">
                            <div  class="card shadow-lg">
                                <img src="{{ asset('admin1/image/COC2.png') }}" class="card-img " alt="...">
                            </div>
                        </div>
                </div>
            </div>
        </section>-->
        <br>
    </div>
</div>
@endsection


