@extends('welcome')

@section('title', 'Event')
@section('mainContent')

    <div class="container-fluid">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" id="textL">
                    <a class="breadcrumb-item nav-link" href="{{ route('home') }}">หนัาหลัก</a>
                    <a class="breadcrumb-item nav-link" href="{{ route('eventHome.showAllEvent') }}">กิจกรรมทั้งหมด</a>
                    <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 200px;">
                        {{ $event->event_title }}</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="container">
            <div class="">
                <div class="">
                    <div>
                        <h2 id="textL" class="py-3 text-gray-700">{{ $event->event_title }}</h2>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset($event->event_image_cover) }}" class="card-img-top " height="600px">
                        <h6 id="textL" class="mt-3">วันที่เริ่ม: {{ $event->event_start }} วันที่สิ้นสุด:
                            {{ $event->event_end }}</h6>
                        <div class="card-body">
                            <div>{!! $event->description !!}</div>
                        </div>
                        <div class="mt-3">
                            <div class="mt-3">
                                @hasanyrole([1, 2])
                                    @if (auth()->user()->alumni == 1  )
                                        @if ($btnStatus == 1)
                                            <form method="POST" action="{{ route('eventHome.joinEventH') }}">
                                                @csrf
                                                <button class="btn btn-success" name="eventId"
                                                    value="{{ $event->id }}">เข้าร่วมกิจกรรม</button>
                                            </form>
                                        @elseif ($btnStatus == 2)
                                            <button class="btn btn-warning active">คุณเข้าร่วมกิจกรรมนี้แล้ว</button>
                                        @elseif ($btnStatus == 3)
                                            <button class="btn btn-danger active">หมดระยะเวลากิจกรรม</button>
                                        @endif
                                    @else
                                        @if ($btnStatus == 1)
                                            <form method="POST" action="{{ route('eventHome.joinEventH') }}">
                                                @csrf
                                                <button class="btn btn-success" name="eventId"
                                                    value="{{ $event->id }}">ขอสิทธิ์เข้าร่วมกิจกรรม</button>
                                            </form>
                                        @elseif (($btnStatus == 4))
                                            <button class="btn btn-secondary   active">รอดำเนินการ</button>
                                        @elseif ($btnStatus == 2)
                                            <button class="btn btn-warning active">คุณเข้าร่วมกิจกรรมนี้แล้ว</button>
                                        @elseif ($btnStatus == 3)
                                            <button class="btn btn-danger active">หมดระยะเวลากิจกรรม</button>
                                        @endif
                                    @endif
                                @endhasanyrole
                            </div>

                            @hasanyrole([1, 2])
                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal"
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
                                                        @foreach ($userEvent as $uEvent)
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
                            </div>
                            @endhasanyrole
                        </div>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne" id="textF">
                                    {{ 'รูปกิจกรรม' }}
                                </button>
                            </h2>
                            <br>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div>
                                    @foreach ($event->attachments as $att)
                                        <img class="mb-1" src="{{ asset($att->path) }}" alt=""
                                            height="200px auto">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
