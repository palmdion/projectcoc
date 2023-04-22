@extends('admin.index')

@section('title', 'Event Created')

@section('content')

<div class="container-fluid">

    <!-- Alert Messages -->
    @include('admin.alert')


    <div class="card">
        <div class="card-body ">
            <form class="row g-3" method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data">
                @csrf
                <!---->
                <div class="col-md-6">
                    <label for="date" class="form-label">Date Start</label>
                    <input type="text"
                        class="form-control form-control @error('date') is-invalid @enderror"
                        id="date"
                        placeholder=""
                        name="date"
                        value="{{ old('education_start') }}">
                        @error('date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <!-- -->
                 <!---->
                 <div class="col-md-6">
                    <label for="date" class="form-label">Date End</label>
                    <input type="text"
                        class="form-control form-control @error('date') is-invalid @enderror"
                        id="date"
                        placeholder=""
                        name="date"
                        value="{{ old('education_end') }}">
                        @error('date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <!-- -->



                    {{--<!-- Start Date -->
                    <div class="form-group col-md-6">
                        <label for="education_end ">Start Date</label>
                        <select class="form-control" name="">
                            <option selected>Select Date</option>
                            <?php
                            for ($yearStart = (int)date('Y'); 1900 <= $yearStart; $yearStart--): ?>
                                <option valu="{{ old('event_start') }}"><?=$yearStart;?></option>
                            <?php endfor; ?>
                        </select >
                        @error('date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- END Start Date -->

                    <!-- End Date -->
                    <div class="form-group col-md-6">
                        <label for="education_end">End Date</label>
                        <select class="form-control" name="">
                            <option selected>Select Date</option>
                            <option {{ old('event_end') }}>กำลังศึกษาอยู่</option>
                            <?php
                            for ($yearEnd = (int)date('Y'); 1900 <= $yearEnd; $yearEnd--): ?>
                              <option valu="{{ old('event_end') }}"><?=$yearEnd;?></option>
                            <?php endfor; ?>
                        </select >
                        @error('date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- END Date End -->--}}


                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Department</label>
                        <select class="form-control @error('department') is-invalid @enderror" name="department">
                            <option selected disabled>Select Role</option>
                            @foreach ($department as $depart)
                                <option value="{{$depart->id}}">{{$depart->degree_fullName}}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Student Number -->
                    <div class="col-md-12">
                        <label for="edocation_title" class="form-label">Student Number</label>
                        <input type="text"
                            class="form-control form-control @error('Student Number') is-invalid @enderror"
                            id="student_number"
                            placeholder="Student Number"
                            name="student_number"
                            value="{{ old('student_number') }}">
                            @error('Student Number')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <!-- END Student Number -->

                    <!-- University -->
                    <div class="col-md-6">
                        <label for="university" class="form-label">University</label>
                        <input type="text"
                            class="form-control form-control @error('university') is-invalid @enderror"
                            id="university"
                            placeholder="University"
                            name="university"
                            value="{{ old('university') }}">
                            @error('university')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <!-- END University -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-post float-right mb-3">Save</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('education.index') }}">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
