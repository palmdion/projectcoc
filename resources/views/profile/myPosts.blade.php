@extends('profile.detail')

@section('title', 'My Posts')

@section('contentProfile')

    <div class="container-fluid">

        <div class=" mb-4">
            <h1 id="textF" class="h3 mb-0 text-gray-800">ข่าวสารของฉัน</h1>
        </div>

        <div class="py-3">
            <a class="btn btn-primary" href="{{ route('profile.addPost') }}">เพิ่มข่าวสาร</a>
        </div>

        <!-- Alert Messages -->
        @include('admin.alert')

        <!-- ตารางข้อมูลโพสต์ -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ข่าวสารของฉัน</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="">หัวเรื่อง</th>
                                <th width="">อธิบายรายละเอียด</th>
                                <th width="">รูปปกข่าวสาร</th>
                                <th width="">ประเภท</th>
                                {{-- <th width="">แท็ก</th> --}}
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="text-truncate" >
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-truncate"  style="max-width: 150px">{{ $post->post_title }}</td>
                                    <td class="text-truncate" id="description-text" >
                                        {!! $post->description !!}
                                    </td>
                                    <td><img width="100px" height="50px" src="{{ asset($post->post_image) }}"
                                            alt=""></td>
                                    <td>{{ $post->category ? $post->category->pluck('cate_name')->first() : 'N/A' }}
                                    </td>
                                    {{-- <td>{{ $post->tag ? $post->tag->pluck('tag_name')->first() : 'N/A' }}
                                    </td> --}}
                                    <td class="d-flex">
                                        <div class="m-1"><a class="btn btn-primary   "
                                                href="{{ route('postHome.showPost', $post->id) }}">แสดง</a></div>
                                        <div class="m-1"><a class="btn btn-warning  "
                                                href="{{ route('profile.editPost', $post->id) }}}">แก้ไข</a></div>
                                        <form method="POST" action="{{ route('profile.deletePost', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-1" type="submit">
                                                ลบ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
