@extends('admin.index')

@section('title', 'Posts Created')

@section('content')

    <div class="container-fluid">

        <!-- Alert Messages -->
        @include('admin.alert')


        <div class="card">
            <div class="card-body ">
                <form class="row-cols-1 g-3" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Post -->
                    <div class="col-md-12">
                        <label for="post_title" class="form-label">หัวเรื่อง</label>
                        <input type="text" class="form-control form-control @error('post_title') is-invalid @enderror"
                            id="post_title" placeholder="หัวเรื่องข่าวสาร" name="post_title"
                            value="{{ old('post_title') }}">
                    </div>


                    <!-- Category -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="category" class="form-label">ประเภทข่าวสาร</label>
                        <select class="form-control " name="categories">
                            <option selected disabled>เลือกประเภทข่าวสาร</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- END Category -->

                    {{-- <div class="form-group">
                        <input type="file" class="form-control" name="image" />
                    </div> --}}

                    <!-- Image -->
                    <div class="col-md-6 mt-3">
                        <label for="post_image" class="form-label">อัพโหลดรูป</label>
                        <input class="form-control @error('post_image') is-invalid @enderror" type="file" id="post_image"
                            placeholder="Image Post" name="post_image" value="{{ old('post_image') }}" multiple>
                        @error('post_image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <!-- Tag -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">

                        <label for="category" class="form-label">แท็กข่าวสาร</label>

                        <select class="form-control " name="categories">
                            <option selected disabled>เลือกแท็กข่าวสาร</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                            @endforeach
                        </select>
                         @foreach ($tags as $tag)
                        <div>

                            <input class="form-check-input" type="checkbox" name="tags" value="{{ $tag->id }}">
                            <label>{{ $tag->tag_name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <!-- END Tag --> --}}

                    {{-- <!-- Approval -->
                    <div class="col-md-4">
                        <label for="is_approved" class="form-label">การอนุมัติ</label>
                        <select class="form-control @error('is_approved') is-invalid @enderror" name="is_approved">

                            <option value="1" selected>อนุมัติ</option>
                            <option value="0">รออนุมัติ</option>
                        </select>
                        @error('is_approved')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Approval --> --}}

                    {{-- <!-- Status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">สถานะขอบเขต</label>
                        <select class="form-control  @error('status') is-invalid @enderror" name="status">
                            <option selected disabled>เลือกสถานะขอบเขต</option>
                            <option value="0" selected>สาธารณะ</option>
                            <option value="1">ภายใน</option>
                            <option value="2">สไลด์</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Status --> --}}

                    <!-- Description -->
                    <div class="mt-3">
                        <label for="description" class="form-label">อธิบายรายละเอียด</label>
                        <textarea id="summernote" class="form-control" style="height:150px auto" name="description"
                            placeholder="อธิบายรายละเอียด" required></textarea>
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
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('posts.indexPost') }}">กลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
