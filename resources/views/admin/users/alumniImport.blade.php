@extends('admin.index')

@section('title', 'Import Users')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">การนำเข้าข้อมูลศิษย์เก่า</h1>

    </div>

    <!-- Alert Messages -->
    @include('admin.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">นำเข้าข้อมูลศิษย์เก่า</h6>
        </div>
        <form method="POST" action="{{route('users.uploadAlumni')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <label class="mb-2">อัปโหลดไฟล์ (เอกสารข้อมูล .csv .xlsx )</label>
                        <input
                            type="file"
                            class="form-control form-control-user @error('file') is-invalid @enderror"
                            id="exampleFile"
                            name="file"
                            value="{{ old('file') }}">

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">อัปโหลด</button>
                <a class="btn btn-secondary  float-right mr-3 mb-3" href="{{ route('alumni.indexAlumni') }}">กลับ</a>
            </div>
        </form>
    </div>

</div>


@endsection
