@extends('welcome');

@section('title', 'Add Event')
@section('mainContent')

    <div class="container-fluid">
        <div class="container">
            <div class="">
                <div class="card">
                    <div class="card-body ">
                        <form class="row g-3" method="POST" action="{{ route('eventHome.storeEvent') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Title Event -->
                            <div class="col-md-6">
                                <label for="event_title" class="form-label">Title name</label>
                                <input type="text"
                                    class="form-control form-control @error('event_title') is-invalid @enderror"
                                    id="event_title" placeholder="Title Event" name="event_title"
                                    value="{{ old('event_title') }}">
                            </div>

                            {{-- <div class="form-group">
                                <input type="file" class="form-control" name="image" />
                            </div> --}}

                            <!-- Image -->

                            <div class="col-md-8">
                                <label for="event_image" class="form-label">Input image</label>
                                <input class="form-control" type="file" name="event_image" id="event_image"
                                    value="{{ old('event_image_cover') }}">
                            </div>

                            <!-- END Image-->
                            <!-- Image Multiple-->
                            <div class="col-md-8">
                                <label for="event_image_multiple" class="form-label">Input Gallery</label>
                                <input class="form-control" type="file" name="event_image_multiple[]"
                                    id="event_image_multiple[]" value="{{ old('event_gallery') }}" multiple>
                            </div>
                            <!-- END Image Multiple -->

                            <div class="form-group">
                                <label for="event_start">Start Date</label>
                                <input type="date" class="form-control" id="event_start" name="event_start"
                                    value="{{ old('event_start') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="event_end">End Date</label>
                                <input type="date" class="form-control" id="event_end" name="event_end"
                                    value="{{ old('event_end') }}" required>
                            </div>

                            <!-- Description -->
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
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
    </div>
@endsection
