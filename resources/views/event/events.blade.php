@extends('welcome');

@section('title', 'Event')
@section('mainContent')

<div>
    <div class="container-fluid  bg-white">
        <nav aria-label="breadcrumb" id="textL">
            <ol class="breadcrumb">
              <a class="breadcrumb-item nav-link" href="{{ route('home') }}">หน้าหลัก</a>
              <li class="breadcrumb-item active" aria-current="page">กิจกรรมทั้งหมด</li>
            </ol>
        </nav>
        <br>
        <div id="textL" class="container  ">
            <h2>กิจกรรมทั้งหมด</h2>
        </div>
    </div>
    <br>
    @hasanyrole(['Admin','Staff'])
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('eventHome.eventAdd') }}">สร้างกิจกรรม</a>
    </div>
    @endhasanyrole
    <div id="line"></div>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($events as $event)
                <div class="col" >
                    <div  class="card h-100 shadow">
                        <a href="#"><img src="{{asset($event->event_image_cover)}}" class="card-img-top" alt="" height="250px"></a>
                        <div class="card-body">
                            <h5 style="color: #0F75BC;" class="card-title">{{ $event->event_title }}</h5>
                            <p class="card-text text-truncate">{{ $event->description }}</p>
                            <span>
                                <p class="card-text text-truncate">{{ $event->event_start }} - {{ $event->event_end }}</p>
                            </span>
                            <div>
                                <a style="color: #0F75BC" class="nav-link stretched-link" id="textMore" href="{{ route('eventHome.showEvent',$event->id) }}">อ่านเพิ่มเติ่ม</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100 shadow-lg">
                        <div class="single-post post-style-1 p-2">
                           <strong>No Event Found  </strong>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<br>
@endsection
