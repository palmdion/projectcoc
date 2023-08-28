@extends('profile.detail')

@section('title', 'Edit Post')

@section('contentProfile')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" id="textF">แก้ไขข่าวสาร</h1>
    </div>


    <!-- Alert Messages -->
    @include('admin.alert')

    <!-- ข้อมูลอีเว้นท์-->
    <div class="card shadow mb-4">


        <div class="card-body">
            <form action="{{ route('profile.updatePost', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        {{-- Title Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>หัวเรื่อง</label>
                            <input
                                type="text"
                                class="form-control form-control-post @error('post_title') is-invalid @enderror"
                                id="post_title"
                                placeholder="หัวเรื่องข่าวสาร"
                                name="post_title"
                                value="{{ $post->post_title }}">
                        </div>
                        <!-- END Title Name -->

                        <!-- Image -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>อัพโหลดรูปข่าวสาร</label>
                            <input
                                type="file"
                                class="form-control form-control-post @error('post_image') is-invalid @enderror"
                                id="post_image"
                                placeholder="post_image"
                                name="post_image"
                                value="{{$post->post_image}}">
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
                            <label>ประเภทข่าวสาร</label>
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
                                <label for="tag">แท็กข่าวสาร</label>
                                @foreach($tags as $tag)
                                    <div class="form-check form-line">
                                        <input class="form-check-input "{{ in_array($tag->id, $post->tag->pluck('id')->toArray()) ? 'checked' : '' }}  type="checkbox" name="tags[]" id="tag"  value="{{$tag->id}}">
                                        <label>{{ $tag->tag_name }}</label>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                        <!-- END Tags -->

                        <!-- Description -->
                        <div >
                            <label for="description" class="form-label">อธิบายรายละเอียด</label>
                            <textarea id="summernote" class="form-control" style="height:150px" name="description" placeholder="อธิบายกิจกรรม" >{!! $post->description !!}</textarea>
                        </div>
                        <script>
                            $('#summernote').summernote({
                                placeholder: 'อธิบายรายละเอียด',
                                tabsize: 2,
                                height: 100
                            });
                        </script>
                        <!-- END Description -->
                    </div>
                    <br>
                    <!-- Action -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a class="btn btn-primary float-right" href="{{ route('profile.myPosts') }}">กลับ</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
