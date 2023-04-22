
@extends('admin.index')

@section('title', 'Posts Edit')

@section('content')

<div class="container-fluid">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Post</h6>
    </div>


    <div class="card">
        <div class="card-body ">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        {{-- Title Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Title Name</label>
                            <input
                                type="text"
                                class="form-control form-control-post @error('post_title') is-invalid @enderror"
                                id="post_title"
                                placeholder="Title Name"
                                name="post_title"
                                value="{{ $post->post_title }}">
                            @error('post_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- END Title Name -->

                        <!-- Image -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Image</label>
                            <input
                                type="file"
                                class="form-control form-control-post @error('post_image') is-invalid @enderror"
                                id="post_image"
                                placeholder="post_image"
                                name="post_image"
                                value="{{$post->post_image}}">
                            @error('post_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <!-- imageOld -->
                            <input type="hidden" name="image_old" value="{{$post->post_image }}">

                            <!-- Show Image -->
                            <div class="form-group mt-1">
                                <img width="400px" height="200px"  src="{{asset($post->post_image)}}" alt="">
                            </div>
                        </div>
                        <!-- END Image -->

                        <!-- Categories -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>Categories</label>
                            <select name="categories[]" id="category" class="form-control ">
                                @foreach($categories as $category)
                                    <option
                                        @foreach($post->category as $postCategory)
                                            {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                        @endforeach
                                        value="{{ $category->id }}">{{ $category->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- END Categories -->

                        <!-- Tags -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <div class=" ">
                                <label for="tag">Select Tag</label>
                                @foreach($tags as $tag)
                                    <div class="form-check form-line">
                                        <input class="form-check-input "{{ in_array($tag->id, $post->tag->pluck('id')->toArray()) ? 'checked' : '' }}  type="checkbox" name="tags[]" id="tag"  value="{{$tag->id}}">
                                        <label>{{ $tag->tag_name }}</label>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                        <!-- END Tags -->
                        <!-- Aproved -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Approved</label>
                        <select class="form-control  @error('is_approved') is-invalid @enderror" name="is_approved">
                            <option selected disabled>Select Approval</option>
                            <option value="1" {{old('is_approved') ? ((old('is_approved') == 1) ? 'selected' : '') : (($post->is_approved == 1) ? 'selected' : '')}}>Approved</option>
                            <option value="0" {{old('is_approved') ? ((old('is_approved') == 0) ? 'selected' : '') : (($post->is_approved == 0) ? 'selected' : '')}}>Pending</option>
                        </select>
                        @error('is_approved')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <!-- END Approval -->
                        <!-- Status -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Status</label>
                        <select class="form-control  @error('status') is-invalid @enderror" name="status">
                            <option selected disabled>Select Approval</option>
                            <option value="0" {{old('status') ? ((old('status') == 0) ? 'selected' : '') : (($post->status == 0) ? 'selected' : '')}}>Public</option>
                            <option value="1" {{old('status') ? ((old('status') == 1) ? 'selected' : '') : (($post->status == 1) ? 'selected' : '')}}>Within</option>
                            <option value="2" {{old('status') ? ((old('status') == 2) ? 'selected' : '') : (($post->status == 2) ? 'selected' : '')}}>Slider</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <!-- END Status -->
                        
                        <div class="col-sm-12 mb-3 mt-3 ">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $post->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Action -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-primary float-right" href="{{ route('posts.indexPost') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>
    <br><br><br>
</div>

@endsection

@section('scripts')

@endsection

