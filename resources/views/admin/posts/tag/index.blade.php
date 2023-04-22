@extends('admin.index')

@section('title', 'Tags')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">จัดการข้อมูลแท็ก</h1>
    </div>
    <div class="mb-2">
        <a href="{{route('posts.indexPost')}}" class="btn btn-secondary shadow-sm"> กลับ</a>
    </div>

    {{-- Alert Messages --}}
    @include('admin.alert')

    <!-- ตารางข้อมูลแท็ก(Tags) -->
<div class="row justify-content-end">
    <div class="col card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลแท็ก</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered  " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="">ชื่อแท็ก</th>
                            <th width="">อธิบายรายละเอียด</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->tag_name }}</td>
                                <td>{{ $tag->description }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('tag.edit', $tag->id) }}"
                                        class="btn btn-primary m-2">แก้ไข
                                    </a>
                                    <form method="POST" action="{{ route('tag.delete', $tag->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            ลบ
                                        </button>
                                   </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tags->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- Create Catagory -->
    <div class="col-4">
        <div class=" card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">เพิ่มแท็ก</h6>
            </div>
            <form method="POST" action="{{route('tag.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <!-- Category Name -->
                        <div class=" mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ชื่อแท็ก</label>
                            <input
                                type="text"
                                class="form-control form-control @error('tag_name') is-invalid @enderror"
                                id="TagName"
                                placeholder="Tag Name"
                                name="tag_name"
                                value="{{ old('_name') }}">
                            @error('tag_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                       <!-- Description -->
                        <div class="col mt-2">
                            <label for="description" class="form-label mb-2">อธิบายรายละเอียด</label>
                            <textarea class="form-control" style="height:100px" name="description" placeholder="Description"></textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- END Description -->
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-categoy float-right mb-3">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>





</div>

@endsection

@section('scripts')

@endsection
