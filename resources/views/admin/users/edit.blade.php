@extends('admin.index')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">แก้ไขผู้ใช้งาน</h1>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <form method="POST" action="{{route('users.update', $user->id)}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">

                    {{-- First Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>ชื่อ</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                            id="exampleFirstName"
                            placeholder="ชื่อ"
                            name="name"
                            value="{{ old('name') ?  old('name') : $user->name}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>นามสกุล</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                            id="exampleLastName"
                            placeholder="นามสกุล"
                            name="last_name"
                            value="{{ old('last_name') ? old('last_name') : $user->last_name }}">

                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>เมล</label>
                        <input
                            type="email"
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleEmail"
                            placeholder="Email"
                            name="email"
                            value="{{ old('email') ? old('email') : $user->email }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Role --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>บทบาท</label>
                        <select class="form-control form-control-user @error('role_id') is-invalid @enderror" name="role_id">
                            <option selected disabled>เลือกบทบาท</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}"
                                    {{old('role_id') ? ((old('role_id') == $role->id) ? 'selected' : '') : (($user->role_id == $role->id) ? 'selected' : '')}}>
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    {{-- <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>สถานะ</label>
                        <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                            <option selected disabled>เลือกสถานะ</option>
                            <option value="1" {{old('role_id') ? ((old('role_id') == 1) ? 'selected' : '') : (($user->status == 1) ? 'selected' : '')}}>ใช้งาน</option>
                            <option value="0" {{old('role_id') ? ((old('role_id') == 2) ? 'selected' : '') : (($user->status == 0) ? 'selected' : '')}}>ไม่ได้ใช้งาน</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>--}}

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">บันทึก</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">กลับ</a>
            </div>
        </form>
    </div>

</div>


@endsection
