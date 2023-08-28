
@extends('admin.index')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">อัพเดทสถานะ</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form method="POST" action="{{route('sendRequest.update', ['user' => $send->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    <!-- บทบาท -->
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>สถานะ</label>
                        <select class="form-control form-control-user @error('role_id') is-invalid @enderror" name="role_id">
                            <option selected disabled>เลือกสถานะ</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}"
                                    {{old('role_id') ? ((old('role_id') == $role->id) ? 'selected' : '') : (($send->role_id == $role->id) ? 'selected' : '')}}>
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">อัพเดท</button>
                <a class="btn btn-secondary  float-right mr-3 mb-3" href="{{ route('sendRequest.index') }}">กลับ</a>
            </div>
        </form>
    </div>

</div>


@endsection
