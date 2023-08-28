@extends('profile.detail')

@section('title', 'Manage Work')

@section('contentProfile')

    <!-- Alert Messages -->
    @include('admin.alert')
    <div class="mb-3">
        <span>
            <h4 id="textL">เพิ่มอาชีพการทำงาน</h4>
        </span>
    </div>
    <div id="line"></div>
    <br>
    <div class="">
    <div class=" ">
        <div class="card">
            <div class="card-header">
                เพิ่มการทำงาน
            </div>
            <div class="card-body">
                <form action="{{ route('profile.addWork') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="form-group">
                            <label for="name_work" class="form-label">ชื่องาน</label>
                            <input class="form-control " type="text" name="name_work" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="name_work" class="form-label">ชื่อบริษัท</label>
                            <input class="form-control " type="text" name="name_company" value="" required>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <label for="name_work" class="form-label">อธิบายรายละเอียด</label>
                            <textarea name="work_detail" id="summernote" class="form-control" style="height:150px auto"  placeholder="อธิบายรายละเอียด"
                                ></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <script>
                            $('#summernote').summernote({
                                placeholder: 'อธิบายรายละเอียด',
                                tabsize: 2,
                                height: 100
                            });
                        </script>
                        <!-- END Description -->
                        <div class="">
                            <button type="submit" class="btn btn-primary mb-3 me-">ยืนยัน</button>
                            <a class="btn btn-secondary float-right mr-3 mb-3 " href="{{ route('profile.myWork') }}">กลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
