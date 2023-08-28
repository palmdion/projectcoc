@extends('admin.index')
@section('title', 'Events')
@section('content')

    <div class="container-fluid">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">กิจกรรมทั้งหมด   </h1>
        </div>

        <div class="py-3">
            <a class="btn btn-primary" href="{{ route('event.create') }}">เพิ่มกิจกรรม</a>
        </div>

        <!-- Alert Messages -->
        @include('admin.alert')

        <!-- ตารางข้อมูลกิจกรรม -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลกิจกรรม</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="">ผู้สร้างกิจกรรม</th>
                                <th width="">หัวเรื่อง</th>
                                <th width="">อธิบายรายละเอียด</th>
                                <th width="">รูปปกกิจกรรม</th>
                                <th width="">วันที่เริ่ม</th>
                                <th width="">วันที่สิ้นสุด</th>
                                <th width="20%" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr >
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->user->name }} </td>
                                    <td class="text-truncate" style="max-width: 150px">{{ $event->event_title }}</td>
                                    <td class="text-truncate"  id="description-text">{!! $event->description !!}</td>
                                    <td>
                                        <img width="100px" height="50px" src="{{ asset($event->event_image_cover) }}"
                                            alt="">
                                    </td>
                                    <td>{{ $event->event_start }} </td>
                                    <td>{{ $event->event_end }} </td>
                                    <td style="display: flex">

                                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary m-2">แสดง
                                        </a>
                                        <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning  m-2">แก้ไข
                                        </a>
                                        <form method="POST" action="{{ route('event.delete', $event->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-2" type="submit">
                                                ลบ
                                            </button>
                                        </form>
                                            <a href="{{ route('event.export', $event->id) }}" class="btn  btn-success m-2">
                                                 Export
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
