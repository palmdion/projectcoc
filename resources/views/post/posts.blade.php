@extends('welcome')

@section('title', 'Posts')
@section('mainContent')

    <div>
        <div class="container-fluid  bg-white">
            <nav aria-label="breadcrumb" id="textL">
                <ol class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="{{ route('home') }}">Home</a>
                    <li class="breadcrumb-item active" aria-current="page">ข่าวสารประชาสัมพันธ์ทั้งหมด</li>
                </ol>
            </nav>
            <br>
            <div class="container mb-2">
                <h2 style="color: #0F75BC;">ข่าวสารประชาสัมพันธ์ทั้งหมด</h2>
                <nav id="mainPosts" class="navbar navbar-expand-md navbar-light bg-white">
                    <div class="d-flex gap-2">
                        @hasanyrole([1, 2, 3])
                            @if (auth()->user()->role_id == 1 || auth()->user()->alumni == 1)
                                <div class="container mb-2">
                                    <a class="btn btn-outline-primary" href="{{ route('postHome.postAdd') }}">สร้างข่าวสาร</a>
                                </div>
                            @endif
                        @endhasanyrole
                    </div>
                </nav>
            </div>
            <div id="line"></div>
            <br>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($posts as $post)
                    <div class="col">
                        <div class="card h-100 shadow">
                            <a href="#"><img src="{{ asset($post->post_image) }}" class="card-img-top" alt=""
                                    height="250px"></a>
                            <div class="card-body">
                                <h5 style="color: #0F75BC;" class="card-title text-truncate">{{ $post->post_title }}</h5>
                                <div style="height: 150px" class="card-text text-truncate">{!! $post->description !!}</div>
                                <div>
                                </div> <a style="color: #0F75BC" class="nav-link stretched-link" id="textMore"
                                    href="{{ route('postHome.showPost', $post->id) }}">อ่านเพิ่มเติม</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100 shadow-lg">
                            <div class="single-post post-style-1 p-2">
                                <strong>No Post Found : </strong>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <br>
@endsection
