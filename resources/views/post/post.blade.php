@extends('welcome')

@section('title', 'Post')
@section('mainContent')

<div class="container-fluid">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" id="textL">
              <a class="breadcrumb-item nav-link"  href="{{ route('home') }}">Home</a>
              <a class="breadcrumb-item nav-link" href="{{ route('postHome.showAllPost') }}">ข่าวสารประชาสัมพันธ์ทั้งหมด</a>
              <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 200px;">
                {{ $posts->post_title }}</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col-md-9">
                <div>
                    <h2 class="py-3 text-gray-700" id="textF">{{ $posts->post_title }}</h2>
                    <h6 class="mb-3 text-gray-700" id="textL" >{{ $posts->category ? $posts->category->pluck('cate_name')->first() : 'N/A' }}</h6>

                </div>
                <div class="mb-3">
                    <img  src="{{asset($posts->post_image)}}" class="card-img-top " height="500px"  alt="...">
                    <div class="card-body ">

                        <p id="textF"
                                class="mt-3 fw-semibold lh-lg fs-5 text-body text-break">{!! $posts->description !!}</p>
                                <br>
                                <h6 class="card-text">
                                    <p class="card-text ">
                                    <div class="d-flex ">
                                        {{-- @foreach ($posts->tag as $tag )
                                        <p class="text-muted p-2">#{{ $tag->tag_name}}</p>
                                        @endforeach --}}
                                    </div>
                                </p></h6>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <h3>{{ 'ข่าวล่าสุด' }}</h3>
                </div>
                @forelse($post as $postNews)
                <div class="mt-5" >
                    <div class="card border-0">
                        <a href=""><img src="{{asset($postNews->post_image)}}"class="card-img-top shadow-sm w-100" alt=""></a>
                        <a style="color: #0F75BC" class="nav-link tretched-link" href= "{{ route('postHome.showPost',$postNews->id) }}">
                            <p class="mt-2 fw-semibold text-truncate">{{ $postNews->post_title }}</p>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="">
                        <div class="card shadow-lg">
                            <div class="single-post post-style-1 p-2">
                            <strong>No Post Found </strong>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
