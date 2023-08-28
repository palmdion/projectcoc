@extends('admin.index')

@section('title', 'event show')

@section('content')

    <!-- Alert Messages -->
    @include('admin.alert')

    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('event.index') }}" class="btn btn-secondary  waves-effect">กลับ</a>
        <br>
        <br>
        <div class="card mb-3">
            <img height="400px" src="{{ asset($event->event_image_cover) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" id="textL">{{ $event->event_title }}</h5>
                <p class="card-text">{!! $event->description !!}</p>
                <h6 id="textL" class="mt-3">วันที่เริ่ม: {{ $event->event_start }} วันที่สิ้นสุด:
                    {{ $event->event_end }}</h6>
                <br>
                <div>
                    @hasanyrole([1,2])
                    @if (auth()->user()->alumni == 1 || auth()->user()->role_id == 3)
                        @if ($btnStatus == 1)
                            <form method="POST" action="{{ route('eventHome.joinEventH') }}">
                                @csrf
                                <button class="btn btn-success" name="eventId"
                                    value="{{ $event->id }}">เข้าร่วมกิจกรรม</button>
                            </form>
                        @elseif ($btnStatus == 2)
                            <button class="btn btn-warning active" >คุณเข้าร่วมกิจกรรมนี้แล้ว</button>
                        @elseif ($btnStatus == 3)
                            <button class="btn btn-danger active" >หมดระยะเวลากิจกรรม</button>
                        @endif
                    @else
                        <button class="btn btn-success" disabled>เข้าร่วมกิจกรรม</button>
                    @endif
                @endhasallroles
                </div>
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
                                                <th class="col-4" id="textL">ชื่อ</th>
                                                <th class="col-4" id="textL">นามสกุล</th>
                                            </tr>
                                            @foreach ($userEvent as $uEvent)
                                                <tr class="row">
                                                    <td class="col-4 h6" id="textF">
                                                        {{ $uEvent->user->name }}</td>
                                                    <td class="col-4 h6" id="textF">
                                                        {{ $uEvent->user->last_name }} </td>
                                                </tr>
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
            </div>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            รูปกิจกรรม
                        </button>
                    </h2>
                    <br>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div>
                            @foreach ($event->attachments as $att)
                                <img src="{{ asset($att->path) }}" alt="" height="200px">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection
