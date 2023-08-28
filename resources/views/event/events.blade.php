@extends('welcome')

@section('title', 'Event')
@section('mainContent')

<div>
    <div class="container-fluid">
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
    @hasanyrole([1,2,3])
    @if (auth()->user()->role_id == 1 || auth()->user()->alumni == 1)
    <div class="container mb-2">
        <a class="btn btn-outline-primary" href="{{ route('eventHome.eventAdd') }}">สร้างกิจกรรม</a>
    </div>
    @endif
    @endhasanyrole
    <div id="line"></div>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($events as $event)
                <div class="col" >
                    <div  class="card h-100 shadow">
                        <a href="#"><img src="{{asset($event->event_image_cover)}}" class="card-img-top" alt="" width="" height="250px"></a>
                        <div class="card-body">
                            <h5 style="color: #0F75BC;" style="max-width: 200px" class="card-title text-truncate mb-2">{{ $event->event_title }}</h5>
                            <div style="height: 150px" class="card-text text-truncate" >{!! $event->description !!}</div>
                            <span>
                                <p class="card-text text-truncate">{{ $event->event_start }} - {{ $event->event_end }}</p>
                            </span>
                            <div>
                                <a style="color: #0F75BC" class="nav-link stretched-link" id="textMore" href="{{ route('eventHome.showEvent',$event->id) }}">อ่านเพิ่มเติม</a>
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
