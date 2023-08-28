@extends('profile.detail')

@section('title', 'Approve User Event')

@section('contentProfile')

<div class="container-fluid">
    <div class="d-flex ">
        <div><a class="btn btn-secondary  " href="{{ route('profile.myEvent') }}">กลับ</a></div>
    </div>
    <br>
    <div class=" mb-4">
        <h1 id="textL" class="h3 mb-0">{{ $events->event_title }}</h1>
    </div>
    <div id="line"></div>
    <br>
    <!-- Alert Messages -->
    @include('admin.alert')


    <!-- ข้อมูลอีเว้นท์-->
    <div class="container-fluid">
        <br>
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="">ชื่อ</th>
                        <th width="">นามสกุล</th>
                        <th width="">การอนุมัติ</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approves as $approve)
                     @if ($approve->status == 0)
                     <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$approve->user->name}}</td>
                        <td>{{$approve->user->last_name}}</td>
                        <td>
                            @if ($approve->status == 0)
                                <strong>ยังไม่อนุมัติ</strong>
                            @endif
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('profile.updateStatusEvent', ['user_event_id' => $approve->id, 'status' => 1]) }}"
                                class="btn btn-success  m-2">
                                อนุมัติ
                            </a>
                        </td>
                    </tr>
                     @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
