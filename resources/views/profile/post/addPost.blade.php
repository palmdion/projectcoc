@extends('profile.detail')

@section('title', 'Add Post')

@section('contentProfile')

<div class="container-fluid">
    <!-- Alert Messages -->
    @include('admin.alert')

    <div class="container-fluid">
        <div class="container">
            <div class=" mb-4">
                <h1 id="textL" class="h3 mb-0">สร้างข่าวสาร</h1>
            </div>
            <div id="line"></div>
            <br>
            <div class="card">
                <div class="card-body ">
                    <form class="row g-3" method="POST" action="{{ route('profile.postStore') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Title Post -->
                        <div class="col-md-12">
                            <label for="post_title" class="form-label">หัวเรื่อง</label>
                            <input type="text"
                                class="form-control form-control" id="post_title"
                                placeholder="หัวเรื่องข่าวสาร" name="post_title" value="{{ old('post_title') }}" required>
                        </div>

                        <!-- Image -->
                        <div class="col-sm-6 mb-3 mt-3" >
                            <label for="post_image" class="form-label">อัปโหลดรูปปกข่าวสาร</label>
                            <input class="form-control @error('post_image') is-invalid @enderror" type="file"
                                id="post_image" placeholder="Image Post" name="post_image" value="{{ old('post_image') }}"
                                multiple>
                            @error('post_image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Category -->
                        <div class="col-sm-6 mb-3 mt-3 ">
                            <label for="category" class="form-label">หมวดหมู่</label>
                            <select class="form-control " name="categories">
                                <option selected disabled>เลือกหมวดหมู่</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- END Category -->

                        {{-- <!-- Tag -->
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">แท็ก</label>
                            <select name="tags" class="form-control ">
                                <option selected disabled>เลือกแท็ก</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- END Tag --> --}}


                        <!-- Description -->
                        <div>
                            <label for="description" class="form-label">อธิบายรายละเอียด</label>
                            <textarea id="summernote" class="form-control" style="height:150px auto" name="description" placeholder="อธิบายรายละเอียด"
                                required></textarea>
                        </div>
                        <script>
                            $('#summernote').summernote({
                                placeholder: 'อธิบายรายละเอียด',
                                tabsize: 2,
                                height: 100
                            });
                        </script>
                        <!-- END Description -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-post float-right mb-3">บันทึก</button>
                            <a class="btn btn-secondary float-right mr-3 mb-3" href="{{ route('profile.myPosts') }}">กลับ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
