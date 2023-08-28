@extends('welcome')

@section('title', 'Add Event')
@section('mainContent')

    <div class="container-fluid">
        <div class="container">
            <div class="">
                <div class=" mb-4">
                    <h1 id="textL" class="h3 mb-0">สร้างกิจกรรม</h1>
                </div>
                <div id="line"></div>
                <br>
                <!-- Alert Messages -->
                @include('admin.alert')
                <div class="card">
                    <div class="card-body ">
                        <form class="row g-3" method="POST" action="{{ route('eventHome.storeEvent') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Title Event -->
                            <div class="form-group col-md-6">
                                <label for="event_title" class="form-label">หัวเรื่องกิจกรรม</label>
                                <input type="text" class="form-control form-control" id="event_title"
                                    placeholder="หัวเรื่อง" name="event_title" value="{{ old('event_title') }}" required>
                            </div>

                            {{-- <div class="form-group">
                                <input type="file" class="form-control" name="image" />
                            </div> --}}

                            <!-- Image -->

                            <div class="form-group col-md-12">
                                <label for="event_image" class="form-label">อัปโหลดไฟล์รูป</label>
                                <input class="form-control" type="file" name="event_image" id="event_image"
                                    value="{{ old('event_image_cover') }}" required>
                            </div>

                            <!-- END Image-->
                            <!-- Image Multiple-->
                            <div class="form-group col-md-12 ">
                                <label for="event_image_multiple" class="form-label">อัปโหลดไฟล์รูป (อัลบั้ม)</label>
                                <input class="form-control" type="file" name="event_image_multiple[]"
                                    id="event_image_multiple[]" value="{{ old('event_gallery') }}" multiple>
                            </div>
                            <!-- END Image Multiple -->

                            <div class="form-group col-md-6">
                                <label for="event_start">วันที่เริ่มกิจกรรม</label>
                                <input type="date" class="form-control" id="event_start" name="event_start"
                                    value="{{ old('event_start') }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="event_end">วันที่สิ้นสุดกิจกรรม</label>
                                <input type="date" class="form-control" id="event_end" name="event_end"
                                    value="{{ old('event_end') }}" required>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="form-label">อธิบายรายละเอียด</label>
                                <textarea id="summernote" class="form-control" style="height:150px auto" name="description" placeholder="อธิบายกิจกรรม"
                                    required></textarea>
                            </div>
                            <script>
                                $('#summernote').summernote({
                                    placeholder: 'อธิบายรายละเอียด',
                                    tabsize: 2,
                                    height: 100
                                });
                            </script>
                            <!-- END Description -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-post float-right mb-3">บันทึก</button>
                                <a class="btn btn-primary float-right mr-3 mb-3"
                                    href="{{ route('eventHome.showAllEvent') }}">กลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
