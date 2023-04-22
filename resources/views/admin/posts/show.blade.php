@extends('admin.index')

@section('title', 'Posts List')

@section('content')

<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('posts.indexPost') }}" class="btn btn-primary  waves-effect">BACK</a>
    <br>
    <br>
    <div class="card mb-3">
        <img  src="{{asset($posts->post_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $posts->post_title }}</h5>
          <p class="card-text">{{ $posts->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $posts->category ? $posts->category->pluck('cate_name')->first() : 'N/A' }}</small></p>
          <p class="card-text"><small class="text-muted">{{ $posts->tag ? $posts->tag->pluck('tag_name')->first() : 'N/A' }}</small></p>
        </div>
    </div>

</div>

@endsection

@section('scripts')

@endsection
