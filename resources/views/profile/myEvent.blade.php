@extends('profile.detail')

@section('title', 'My Events')

@section('contentProfile')

    <div class="container-fluid">

        <div class=" mb-4">
            <h1 id="textF" class="h3 mb-0 text-gray-800">กิจกรรมของฉัน</h1>
        </div>

        <div class="py-3">
            <a class="btn btn-primary" href="{{ route('profile.addEvent') }}">เพิ่มกิจกรรม</a>
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
                                <th>#</th>
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
                                    <td>{{$loop->iteration }}</td>
                                    <td style="max-width: 150px; max-height:50px;">{{ $event->event_title }}</td>
                                    <td class="text-truncate"  id="description-text">{!! $event->description !!}</td>
                                    <td><img width="100px" height="50px" src="{{ asset($event->event_image_cover) }}"
                                            alt=""></td>
                                    <td>{{ $event->event_start }}</td>
                                    <td>{{ $event->event_end }}</td>
                                    <td class="d-flex">
                                        <div class="m-1"><a class="btn btn-success    "
                                            href="{{ route('profile.eventApprove', $event->id) }}">อนุมัติ</a></div>
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
                                        {{-- <div class="mt-3">
                                                @csrf
                                                <button  type="button" class="btn btn-outline-primary " data-bs-toggle="modal"
                                                    data-bs-target="#user_event">
                                                    รายชื่อผู้เข้าร่วมกิจกรรม
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="user_event" tabindex="-1" aria-labelledby="user_event"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ $event->event_title }}
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h3 id="textF">รายชื่อผู้เข้าร่วมกิจกรรม</h3>
                                                                </div>
                                                                <div>
                                                                    <table class="table">
                                                                        <tr class="row">
                                                                            <th class="col-2" id="textL">#</th>
                                                                            <th class="col-4" id="textL">ชื่อ</th>
                                                                            <th class="col-4" id="textL">นามสกุล</th>
                                                                        </tr>
                                                                        @foreach ($uUserEvent as $uEvent)
                                                                        @if ($uEvent->status == 1)
                                                                        <tr class="row">
                                                                            <td class="col-2 h6" id="textF">{{ $loop->iteration }}
                                                                            </td>
                                                                            <td class="col-4 h6" id="textF">
                                                                                {{ $uEvent->user->name }}</td>
                                                                            <td class="col-4 h6" id="textF">
                                                                                {{ $uEvent->user->last_name }} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">กลับ</button>
                                                                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> --}}
                                        <a href="{{ route('event.export', ['event' => $event->id]) }}" class="btn  btn-success m-1">
                                            Export
                                       </a>
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
