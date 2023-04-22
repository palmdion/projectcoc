@extends('profile.detail')

@section('title', 'My Events')

@section('contentProfile')

    <div class="container-fluid">
        <div class="mb-4">
            <a class="btn btn-outline-primary  " href="{{ route('profile.profileFace') }}">โปรไฟล์ของฉัน</a>
            <a class="btn btn-outline-primary" href="{{ route('profile.manageProfile') }}">แก้ไขโปรไฟล์</a>
            @if (auth()->user()->alumni == 1)
                <a class="btn btn-outline-primary" href="{{ route('profile.myPosts') }}">ข่าวสารของฉัน</a>
            @endif
            @hasanyrole(['Staff', 'Admin'])
                <a class="btn btn-outline-primary active" href="{{ route('profile.myEvent') }}">กิจกรรมของฉัน</a>
            @endhasanyrole
        </div>


        <div class=" mb-4">
            <h1 id="textF" class="h3 mb-0 text-gray-800">กิจกรรมของฉัน</h1>
        </div>

        <div class="py-3">
            <a class="btn btn-primary" href="{{ route('eventHome.eventAdd') }}">เพิ่มกิจกรรม</a>
        </div>

        <!-- Alert Messages -->
        @include('admin.alert')
        <!-- ตารางข้อมูลโพสต์ -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 id="textL" class="m-0 font-weight-bold text-primary">กิจกรรมของฉัน</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="">หัวเรื่อง</th>
                                <th width="">อธิบายรายละเอียด</th>
                                <th width="">รูปปกกิจกรรม</th>
                                <th width="">วันที่เริ่ม</th>
                                <th width="">วันที่สิ้นสุด</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->event_title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td><img width="100px" height="50px" src="{{ asset($event->event_image_cover) }}"
                                            alt=""></td>
                                    <td>{{ $event->event_start }}</td>
                                    <td>{{ $event->event_end }}</td>
                                    <td class="d-flex">
                                        <div class="m-1"><a class="btn btn-primary   "
                                                href="{{ route('eventHome.showEvent', $event->id) }}">แสดง</a></div>
                                        <div class="m-1"><a class="btn btn-warning  "
                                                href="{{ route('profile.editEvent', $event->id) }}">แก้ไข</a></div>
                                        <form method="POST" action="{{ route('profile.deleteEvent', $event->id) }}">
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
