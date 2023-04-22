@extends('welcome');

@section('title', 'Add Post')
@section('mainContent')

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-body ">
                <form class="row g-3" method="POST" action="{{ route('postHome.storePost') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title Post -->
                        <div class="col-md-6">
                        <label for="post_title" class="form-label">Title name</label>
                        <input type="text"
                            class="form-control form-control @error('post_title') is-invalid @enderror"
                            id="post_title"
                            placeholder="Title Post"
                            name="post_title"
                            value="{{ old('post_title') }}">
                        </div>


                        <!-- Image -->
                        <div class="col-md-8">
                            <label for="post_image" class="form-label">Input image</label>
                            <input class="form-control @error('post_image') is-invalid @enderror" type="file"
                            id="post_image"
                            placeholder="Image Post"
                            name="post_image"
                            value="{{ old('post_image') }}" multiple>
                            @error('post_image')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                        </div>
                        <!-- Category -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control " name="categories">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->cate_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <!-- END Category -->

                        <!-- Tag -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Tag</label>
                            @foreach ($tags as $tag)
                            <div>
                                <input class="form-check-input" type="checkbox" name="tags" value="{{ $tag->id }}">
                                <label>{{ $tag->tag_name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <!-- END Tag -->


                       <!-- Description -->
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                        </div>
                        <!-- END Description -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-post float-right mb-3">Save</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{-- route('posts.indexPost') --}}">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
