@extends('admin.index')

@section('title', 'Send request')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">การติดต่อ</h1>

    </div>
    <!-- Alert Messages -->
    @include('admin.alert')
    <!-- ตารางข้อมูลโพสต์ -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลการติดต่อ</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">ผู้ติดต่อ</th>
                            <th width="">เบอร์โทร</th>
                            <th width="">เมลติดต่อ</th>
                            <th width="">หัวเรื่อง</th>
                            <th width="">อธิบายรายละเอียด</th>
                            <th width="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sendRequest as $send)
                            <tr>
                                <td>{{ $send->id }}</td>
                                <td>{{ $send->user->name }} </td>
                                <td>{{ $send->mobile_number }} </td>
                                <td>{{ $send->mail_address }} </td>
                                <td class="text-truncate" style="max-width: 150px;">{{ $send->subject }}</td>
                                <td class="text-truncate" id="description-text">{!! $send->description !!}</td>
                                <td>
                                      <div class="d-flex ">
                                        <a href="{{ route('sendRequest.show',$send->id) }}"
                                            class="btn btn-primary m-2">แสดง
                                        </a>
                                    {{-- <a href="{{ route('sendRequest.edit', ['user' => $send->user->id]) }}"
                                        class="btn btn-warning  m-2">อัพเดทสถานะ
                                    </a> --}}
                                        <form method="POST" action="{{ route('sendRequest.delete', $send->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-2" type="submit">
                                                ลบ
                                            </button>
                                        </form>
                                      </div>
                                </td>
                                {{-- <td>@if ($send->user->role_id == 3)
                                    <strong class="badge bg-success">อนุญาต</strong>
                                    @else
                                    <strong class="badge bg-secondary">ไม่ได้อนุญาต</strong>
                                    @endif </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- $posts->links('pagination::bootstrap-5') --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
