@extends('profile.detail')

@section('title', 'Edit Work Profile')

@section('contentProfile')

    <div class="container-fluid">

        <!-- Alert Messages -->
        @include('admin.alert')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แก้ไขอาชีพการทำงาน</h1>
        </div>
        <div id="line"></div>
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


                        <div class="col-sm mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">ชื่ออาชีพ</label>
                            <input type="text"
                                class="form-control form-control-post "
                                id="work_name" placeholder="Title Name" name="work_name"
                                value="{{ $work->work_name }}">
                        </div>
                        {{-- <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">อธิบายรายละเอียด</label>
                            <input type="text"
                                class="form-control form-control-post "
                                id="description" placeholder="Title Name" name="description"
                                value="{{ $work->description }}">
                        </div> --}}
                        <div class="col-sm mb-3 mt-3 mb-sm-0">
                            <label class="mb-2">สถานที่ทำงาน</label>
                            <input type="text"
                                class="form-control "
                                id="company_name" placeholder="Title Name" name="company_name"
                                value="{{ $work->company_name }}">
                        </div>
                         <!-- Description -->
                         <div class="mb-3 mt-3 mb-sm-0" >
                            <label for="description" class="form-label">อธิบายรายละเอียด</label>
                            <textarea id="summernote" class="form-control" style="height:150px" name="description" placeholder="อธิบายกิจกรรม" >{!! $work->description !!}</textarea>
                        </div>
                        <script>
                            $('#summernote').summernote({
                                placeholder: 'อธิบายรายละเอียด',
                                tabsize: 2,
                                height: 100
                            });
                        </script>
                        <!-- END Description -->
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a class="btn btn-secondary  float-right" href="{{ route('profile.myWork') }}">กลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
