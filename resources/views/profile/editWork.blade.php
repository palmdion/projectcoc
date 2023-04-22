@extends('profile.detail')

@section('title', 'Edit Work Profile')

@section('contentProfile')

    <div class="container-fluid">

        <!-- Alert Messages -->
        @include('admin.alert')
        <div class="mb-4">
            <a class="btn btn-outline-primary  " href="{{ route('profile.profileFace') }}">โปรไฟล์ของฉัน</a>
            <a class="btn btn-outline-primary active" href="{{ route('profile.manageProfile') }}">แก้ไขโปรไฟล์</a>
            @if (auth()->user()->alumni == 1)
                <a class="btn btn-outline-primary" href="{{ route('profile.myPosts') }}">ข่าวสารของฉัน</a>
            @endif
            @hasanyrole(['Staff', 'Admin'])
                <a class="btn btn-outline-primary" href="{{ route('profile.myEvent') }}">กิจกรรมของฉัน</a>
            @endhasanyrole
        </div>
        <br>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขอาชีพการทำงาน</h1>
        </div>
        <div id="line"></div>
        <br>
        <a class="btn btn-secondary  float-right" href="{{ route('profile.manageProfile') }}">กลับ</a>
        <br>
        <br>
        <!-- ข้อมูลอีเว้นท์-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">แก้ไขอาชีพการทำงาน</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('profile.updateWork', $work->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row card-body">
                        <!-- depart -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <div class="form-group">
                                <label for="category" class="form-label">หมวดหมู่อาชีพ</label>
                                <select class="form-control " name="categories" required>
                                    @foreach ($cateWork as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->cateWork_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ชื่ออาชีพ</label>
                            <input type="text"
                                class="form-control form-control-post "
                                id="work_name" placeholder="Title Name" name="work_name"
                                value="{{ $work->work_name }}">
                        </div>
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">อธิบายรายละเอียด</label>
                            <input type="text"
                                class="form-control form-control-post "
                                id="description" placeholder="Title Name" name="description"
                                value="{{ $work->description }}">
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">สถานที่ทำงาน</label>
                            <input type="text"
                                class="form-control "
                                id="company_name" placeholder="Title Name" name="company_name"
                                value="{{ $work->company_name }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
