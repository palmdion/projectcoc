@extends('admin.index')

@section('title', 'Event Created')

@section('content')


<div class="container">
    <br>
    <h3 id="textF">เพิ่มกิจกรรม</h3>
    <br>
      <!-- Alert Messages -->
      @include('admin.alert')
    <div class="">
        <div class="card">
            <div class="card-body ">
                <form class="row g-3" method="POST" action="{{ route('event.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Title Event -->
                    <div class="col-md-6">
                        <label for="event_title" class="form-label">หัวเรื่องกิจกรรม</label>
                        <input type="text"
                            class="form-control form-control @error('event_title') is-invalid @enderror"
                            id="event_title" placeholder="หัวเรื่อง" name="event_title"
                            value="{{ old('event_title') }}">
                    </div>

                    {{-- <div class="form-group">
                        <input type="file" class="form-control" name="image" />
                    </div> --}}

                    <!-- Image -->

                    <div class="col-md-8">
                        <label for="event_image" class="form-label">อัพโหลดรูปปกกิจกรรม</label>
                        <input class="form-control" type="file" name="event_image" id="event_image"
                            value="{{ old('event_image_cover') }}">
                    </div>

                    <!-- END Image-->


                    <div class="form-group">
                        <label for="event_start">วันที่เริ่มกิจกรรม</label>
                        <input type="date" class="form-control" id="event_start" name="event_start"
                            value="{{ old('event_start') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="event_end">วันที่สิ้นสุดกิจกรรม</label>
                        <input type="date" class="form-control" id="event_end" name="event_end"
                            value="{{ old('event_end') }}" required>
                    </div>

                     <!-- Image Multiple-->
                     <div class="col-md-8">
                        <label for="event_image_multiple" class="form-label">อัพโหลดแกลอรี่รูปกิจกรรม</label>
                        <input class="form-control" type="file" name="event_image_multiple[]"
                            id="event_image_multiple[]" value="{{ old('event_gallery') }}" multiple>
                    </div>
                    <!-- END Image Multiple -->

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">อธิบายรายละเอียด</label>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="อธิบายกิจกรรม"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- END Description -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-post float-right mb-3">Save</button>
                        <a class="btn btn-primary float-right mr-3 mb-3"
                            href="{{ route('eventHome.showAllEvent') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
