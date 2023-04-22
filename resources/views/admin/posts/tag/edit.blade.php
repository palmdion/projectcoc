
@extends('admin.index')

@section('title', 'Category Edit')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">แก้ไขแท็ก</h1>

    </div>
    <div class="mb-2">
        <a href="{{route('tag.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary   shadow-sm"> กลับ</a>
    </div>
    {{-- Alert Messages --}}
    @include('admin.alert')


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">แก้ไขแท็ก</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tag.update' ,$tags->id ) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">

                    <!-- Name -->
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="mb-2">ชื่อแท็ก</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('cate_name') is-invalid @enderror"
                            id="cate_name"
                            placeholder="cate_name"
                            name="cate_name"
                            value="{{ $tags->tag_name }}">
                    </div>
                    <!-- END Name-->

                      <!-- Description -->
                      <div class="col-sm-12 mb-3 mt-3 ">
                        <div class="form-group">
                            <label class="mb-2" for="description">อธิบายรายละเอียด</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $tags->description }}</textarea>
                        </div>
                    </div>
                     <!-- END  Description -->


                </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    บันทึก
                </button>

            </form>
        </div>
    </div>

</div>
{{--<div class="container-fluid">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
    </div>


    <div class="card">
        <div class="card-body ">
            <form action="{{ ($categories->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Category Name</label>
                            <input
                                type="text"
                                class="form-control form-control-post @error('cate_name') is-invalid @enderror"
                                id="catenName"
                                placeholder="Category Name"
                                name="cate_name"
                                value="{{ $categories->cate_name }}">
                        </div>
                        <!-- END  Name -->

                         <!-- Description -->
                        <div class="col-sm-12 mb-3 mt-3 ">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $categories->description }}</textarea>
                            </div>
                        </div>
                         <!-- END  Description -->
                    </div>
                    <br>
                    <!-- Action -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-primary float-right" href="{{ route('category.index') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>
    <br><br><br>
</div>--}}
@endsection

@section('scripts')

@endsection

