@extends('admin.index')

@section('title', 'Posts List')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">จัดการข้อมูลข่าวสาร</h1>

    </div>

    <div class="d-sm-flex py-3 justify-content-between">
        <a class="btn btn-primary" href="{{ route('posts.create') }}">เพิ่มข่าวสาร</a>
        <div class="">
        <a class="btn btn-success " href="{{ route('category.index') }}">ประเภทข่าวสาร</a>
        <a class="btn btn-info " href="{{ route('tag.index') }}">แท็ก</a>
        </div>
    </div>

    <!-- Alert Messages -->
    @include('admin.alert')
    <!-- ตารางข้อมูลโพสต์ -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลข่าวสาร</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">ผู้สร้างข่าสาร</th>
                            <th width="">หัวเรื่อง</th>
                            <th width="">อธิบายรายละเอียด</th>
                            <th width="">รูปปกข่าวสาร</th>
                            <th width="">ประเภท</th>
                            <th width="">แท็ก</th>
                            <th width="10%" >การอนุมัติ</th>
                            <th width="10%">สถานะ</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }} </td>
                                <td class="text-truncate" style="max-width: 150px;">{{ $post->post_title }}</td>
                                <td class="text-truncate" style="max-width: 100px;">{{ $post->description }}</td>
                                <td>
                                    <img width="100px" height="50px"   src="{{asset($post->post_image)}}" alt="">
                                </td>
                                <td>{{ $post->category ? $post->category->pluck('cate_name')->first() : 'N/A' }}</td>
                                <td>{{ $post->tag? $post->tag->pluck('tag_name')->first() : 'N/A' }}</td>
                                <td>@if ($post->is_approved == 0)
                                    <strong>รออนุมัติ</strong>
                                    @elseif ($post->is_approved == 1)
                                        <strong>อนุมัติ</strong>
                                    @endif</td>
                                <td>@if ($post->status == 0)
                                    <strong>สาธารณะ</strong>
                                    @elseif ($post->status == 1)
                                        <strong>ภายในเว็บไซต์</strong>
                                    @elseif ($post->status == 2)
                                        <strong>สไลด์ข่าว</strong>
                                    @endif</td>
                                <td style="display: flex">
                                    <a href="{{ route('posts.show',$post->id) }}"
                                        class="btn btn-primary m-2">แสดง
                                    </a>
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="btn btn-warning  m-2">แก้ไข
                                    </a>
                                    <form method="POST" action="{{ route('posts.delete', $post->id) }}">
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
                {{$posts->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
