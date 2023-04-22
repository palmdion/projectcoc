@extends('admin.index')

@section('title', 'Users List')

@section('content')

<div class="container-fluid" id="users" role="tabpanel" aria-labelledby="users" tabindex="0">
    <!-- Page Heading -->
    <div class="d-sm-flex justify-content-between  mb-4 p-4">
        <h1 class="h3 mb-0 text-gray-800 ">ผู้ใช้ทั้งหมด</h1>
        <div class="row row-cols-md-4  ">
            <div class="col-md-4">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{  route('users.import')  }}" class="btn btn-sm btn-success">
                     นำเข้าข้อมูลผู้ใช้งาน
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{  route('users.importAlumni')  }}" class="btn btn-sm btn-success">
                     นำเข้าข้อมูลศิษย์เก่า
                </a>
            </div>
            <!--
            <div class="col-md-4">
                <a href="{{ route('users.export') }}" class="btn btn-sm btn-success">
                     Export To Excel
                </a>
            </div>-->

        </div>
    </div>
      <!-- Alert Messages -->
      @include('admin.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลผู้ใช้</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">ชื่อ-สกุล</th>
                            <th width="">อีเมล</th>
                            <th width="">ยืนยันสิทธิ์</th>
                            <th width="">บทบาท</th>
                            <th width="">สถานะ</th>
                            <th width="30%">Action</th>
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
                                        <span>ผู้ใช้ทั้วไป</span>
                                    @else
                                        <span>ศิษย์เก่า</span>
                                    @endif
                                </td>
                                <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td>
                                <td>
                                    @if ($user->status == 0)
                                        <span class="badge bg-warning text-black  "> ไม่ได้ใช้งาน</span>

                                    @elseif ($user->status == 1)
                                        <span class="badge bg-success  ">ใช้งาน</span>
                                    @endif
                                </td>
                                <td style="display: flex">
                                    @if ($user->status == 1)
                                    <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                        class="btn btn-success m-2">
                                        ใช้งาน
                                    </a>
                                    @elseif ($user->status == 0)


                                        <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                            class="btn btn-warning m-2">
                                            ไม่ได้ใช้งาน
                                        </a>
                                    @endif
                                    <a href="{{-- route('users.edit', ['user' => $user->id]) --}}"
                                        class="btn btn-primary   m-2">
                                        แสดง
                                    </a>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                        class="btn btn-warning  m-2">
                                        แก้ไข
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy',['user' => $user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            ลบ
                                        </button>
                                   </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
