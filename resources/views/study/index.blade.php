@extends('admin.index')

@section('title', 'Education List')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Management</h1>
    </div>

    <!-- ตารางข้อมูลปีเข้าศึกษา -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Class of</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Class of</th>
                            <th width="">Generation</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admisions as $admision)
                            <tr>
                                <td>{{ $admision->id }}</td>
                                <td>{{ $admision->year_admision }}</td>
                                <td>{{ $admision->generation }}</td>
                                <td style="display: flex">
                                    <a href=""
                                        class="btn btn-primary m-2">Edit
                                    </a>
                                    <a class="btn btn-danger m-2" href="" data-toggle="modal" data-target="#deleteModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                {{--$education->links('pagination::bootstrap-5') --}}
                </table>

            </div>
        </div>
    </div>

    <!-- ตารางข้อมูลระดับการศึกษา -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Education</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Full Name</th>
                            <th width="">Short Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $education)
                            <tr>
                                <td>{{ $education->id }}</td>
                                <td>{{ $education->edu_full_name }}</td>
                                <td>{{ $education->edu_short_name }}</td>
                                <td style="display: flex">
                                    <a href=""
                                        class="btn btn-primary m-2">Edit
                                    </a>
                                    <a class="btn btn-danger m-2" href="" data-toggle="modal" data-target="#deleteModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                {{--$education->links('pagination::bootstrap-5') --}}
                </table>

            </div>
        </div>
    </div>

     <!-- ตารางข้อมูลหลักสูตรวิชา -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Departments</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Education Name</th>
                            <th width="">Full Name</th>
                            <th width="">Short Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->education_name }}</td>
                                <td>{{ $department->depart_full_name }}</td>
                                <td>{{ $department->depart_short_name }}</td>
                                <td style="display: flex">
                                    <a href=""
                                        class="btn btn-primary m-2">Edit
                                    </a>
                                    <a class="btn btn-danger m-2" href="" data-toggle="modal" data-target="#deleteModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                {{--$education->links('pagination::bootstrap-5') --}}
                </table>

            </div>
        </div>
    </div>

     <!-- ตารางข้อมูลชื่อปริญญา -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Degrees</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Department Name</th>
                            <th width="">Full Name</th>
                            <th width="">Short Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($degrees as $degree)
                            <tr>
                                <td>{{ $degree->id }}</td>
                                <td>{{ $degree->departments_name }}</td>
                                <td>{{ $degree->degree_full_name }}</td>
                                <td>{{ $degree->degree_short_name }}</td>
                                <td style="display: flex">
                                    <a href=""
                                        class="btn btn-primary m-2">Edit
                                    </a>
                                    <a class="btn btn-danger m-2" href="" data-toggle="modal" data-target="#deleteModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                {{--$education->links('pagination::bootstrap-5') --}}
                </table>

            </div>
        </div>
    </div>


</div>

@endsection

@section('scripts')

@endsection
