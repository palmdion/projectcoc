@extends('admin.index')

@section('title', 'Users List')

@section('content')

    <div class="container-fluid" id="users" role="tabpanel" aria-labelledby="users" tabindex="0">
        <!-- Page Heading -->
        <h1 class="h3 mb-0 text-gray-800 ">ผู้ใช้ทั้งหมด</h1>
        <div class="d-sm-flex justify-content-end  mb-4 p-4">
            <div class="row row-cols-md-2 g-3 ">
                <div class="col-md">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน
                    </a>
                </div>
                {{-- <div class="col-md">
                    <a href="{{ route('alumni.indexAlumni') }}" class="btn btn-sm btn-outline-primary   ">
                        ข้อมูลศิษย์เก่า
                    </a>
                </div>
                <div class="col-md">
                    <a href="{{ route('users.importAlumni') }}" class="btn btn-sm btn-success    ">
                        นำเข้าข้อมูลศิษย์เก่า
                    </a>
                </div> --}}
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-success   dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        นำเข้าข้อมูล
                    </button>
                    <ul class="dropdown-menu">
                        <!--<li><a class="dropdown-item" href="{{ route('users.import') }}" >
                            ข้อมูลผู้ใช้งาน
                        </a></li>-->
                        <li><a class="dropdown-item" href="{{ route('users.importAlumni') }}">
                                ข้อมูลศิษย์เก่า
                            </a></li>
                    </ul>
                </div> --}}
                <div class="col-md">
                    <a href="{{ route('users.export') }}" class="btn btn-sm btn-success">
                         Export To Excel
                    </a>
                </div>
            </div>
        </div>
        <!-- Alert Messages -->
        @include('admin.alert')

            <!-- DataTales Users -->
            <div class="card shadow-sm mb-4 ">
                <div class="m-3">
                    {{-- <div class="row">
                        <input type="search" class=" c0l-4 form-control" name="keyword" placeholder="Search..." >
                        <div class="mt-4">
                            <button id="reputayionBtn"
                                type="submit"
                                class="btn fw-bolder"
                                style="padding-right:50px;
                                    padding-left:50px;">ค้นหา</button>
                        </div>
                    </div> --}}
                    {{-- <div class="mt-3">
                        <label class="m-2" id="textF" for="">ค้นหา:</label>
                            <input type="search" class="form-control" name="keyword" placeholder="ระบุการค้นหา ชื่อ นามสกุล รหัสนักษาศึกษา" >
                            <div class="mt-4">
                                <button id="reputayionBtn"
                                    type="submit"
                                    class="btn fw-bolder"
                                    style="padding-right:50px;
                                        padding-left:50px;">ค้นหา</button>
                            </div>
                    </div> --}}
                    <div class="py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลผู้ใช้</h6>
                    </div>
                    <div class="">
                            <!-- การค้นหาข้อมูล -->
                    <form  action="{{ route('users.searchUser') }}" method="GET">
                        @csrf
                        <div class="d-flex" >
                            <div class="d-flex ">
                                <form class="">
                                    <input type="search" class="form-control me-2" name="keyword" placeholder="Search" >
                                    <button class="btn btn-outline-info  me-2" type="submit">ค้นหา</button>
                                </form>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="">ชื่อ-สกุล</th>
                                    <th width="">อีเมล</th>
                                    <th width="">ยืนยันศิษย์เก่า</th>
                                    <th width="">บทบาท</th>
                                    {{-- <th width="">สถานะ</th> --}}
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->alumni == 0)
                                                <span>ยังไม่ยืนยัน</span>
                                            @elseif ($user->alumni == 1)
                                                <span>ยืนยันแล้ว</span>
                                            @else
                                                <span>ไม่ทราบ</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td>
                                        {{-- <td>
                                            @if ($user->status == 0)
                                                <span class="badge bg-warning text-black  "> ไม่ได้ใช้งาน</span>
                                            @elseif ($user->status == 1)
                                                <span class="badge bg-success  ">ใช้งาน</span>
                                            @endif
                                        </td> --}}
                                        <td style="display: flex">
                                            {{-- @if ($user->status == 1)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                    class="btn btn-success m-2">
                                                    ใช้งาน
                                                </a>
                                            @elseif ($user->status == 0)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                    class="btn btn-warning m-2">
                                                    ไม่ได้ใช้งาน
                                                </a>
                                            @endif --}}
                                            <!--<a href="{{-- route('users.edit', ['user' => $user->id]) --}}"
                                                class="btn btn-primary   m-2">
                                                แสดง
                                            </a>-->
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-warning  m-2">
                                                แก้ไข
                                            </a>
                                            @if ($user->role_id == 1)
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger m-2" type="submit" disabled>
                                                    ลบ
                                                </button>
                                            </form>

                                            @else
                                            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger m-2" type="submit">
                                                    ลบ
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $users->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
    </div>

@endsection

@section('scripts')

@endsection
