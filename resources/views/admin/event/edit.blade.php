@extends('admin.index')

@section('title', 'Event Edit')

@section('content')

    <div class="container-fluid">
        <div class=" py-3">
            <h3 id="textF">แก้ไขข้อมูลกิจกรรม</h3>
        </div>
        <!-- Alert Messages -->
        @include('admin.alert')

        <div class="card">
            <div class="card-body ">
                <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row-cols-1">
                            <!-- Title Name -->
                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                                <label class="mb-2">หัวเรื่องกิจกรรม</label>
                                <input type="text"
                                    class="form-control form-control-post @error('title') is-invalid @enderror"
                                    id="event_title" placeholder="Title Name" name="event_title"
                                    value="{{ $event->event_title }}">
                            </div>
                            <!-- END Title Name -->

                            <!-- Start Date -->
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <label class="mb-2">วันที่เริ่มกิจกรรม</label>
                                <input type="date" class="form-control  @error('Date') is-invalid @enderror"
                                    id="event_start" placeholder="Start Date" name="event_start"
                                    value="{{ $event->event_start }}">

                            </div>
                            <!-- END Start Date -->

                            <!--  Date End -->
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <label class="mb-2">วันที่สิ้นสุดกิจกรรม</label>
                                <input type="date" class="form-control  @error('Date') is-invalid @enderror"
                                    id="event_start" placeholder="End Date" name="event_end"
                                    value="{{ $event->event_end }}">

                            </div>
                            <!-- END Date End -->

                            <!-- Image -->
                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                                <label class="mb-2">อัพรูปปกกิจกรรม</label>
                                <input type="file"
                                    class="form-control form-control-post @error('image') is-invalid @enderror"
                                    id="event_image" placeholder="image" name="event_image"
                                    value="{{ $event->event_image_cover }}">

                                <!-- imageOld -->
                                <input type="hidden" name="image_old" value="{{ $event->event_image_cover }}">
                                <!-- Show Image -->
                                <div class="form-group mt-1">
                                    <img width="400px" height="200px" src="{{ asset($event->event_image_cover) }}"
                                        alt="">
                                </div>
                            </div>
                            <!-- END Image -->

                            <!-- Image Multiple-->
                            <div class="col-md-12">
                                <br>
                                <label for="event_image_multiple" class="form-label">อัพแกลอรี่รูปกิจกรรม</label>
                                <input class="form-control " type="file" name="event_image_multiple[]" id="event_image_multiple[]"
                                    value="{{ old('event_gallery') }}" multiple>
                                <br>
                                <input type="hidden" id="list_delete" name="list_delete" value="">
                            </div>
                            <div class="col-12 d-flex gap-2 m-0 ">
                                @foreach ($event->attachments as $attachment)
                                            <img class="deleteMe" src="{{ asset($attachment->path) }}"
                                                onClick="delPhoto({{ $attachment->id }})" id="{{ $attachment->id }}"
                                                class="rounded" height="200px" width="auto">
                                @endforeach
                            </div>
                            <br>
                            <!-- END Image Multiple -->

                           <!-- Description -->
                           <div class="mt-3">
                            <label for="description" class="form-label">อธิบายรายละเอียด</label>
                            <textarea id="summernote" class="form-control" style="height:200px" name="description" placeholder="อธิบายกิจกรรม" >{!! $event->description !!}</textarea>
                        </div>
                        <script>
                            $('#summernote').summernote({
                                placeholder: 'อธิบายรายละเอียด',
                                tabsize: 2,
                                height: 100
                            });
                        </script>
                        <!-- END Description -->
                        </div>

                        <!-- Action -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ">บันทึก</button>
                        <a class="btn btn-secondary  float-right" href="{{ route('event.index') }}">กลับ</a>
                    </div>
                </form>
            </div>

        </div>
        <br><br><br>
    </div>

    <style>
        .deleteMe:hover {
            border: 10px solid red;
            filter: blur(5px);
        }
    </style>
    <script>
        var list_id = [];

        function delPhoto(id) {
            list_id.push(id)
            document.getElementById(id).remove();
            document.getElementById("list_delete").value = list_id;
        }
    </script>

@endsection

@section('scripts')

@endsection
