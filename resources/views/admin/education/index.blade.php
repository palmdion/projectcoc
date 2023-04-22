@extends('admin.index')

@section('title', 'Education List')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Management Education User</h1>
    </div>

    <div class="py-3">
        <a class="btn btn-primary" href="{{ route('education.create') }}">Add</a>
    </div>

    <!-- Alert Messages -->
    @include('admin.alert')

    <!-- ตารางข้อมูลการศึกษาขอผู้ใช้งาน -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Education</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Author</th>
                            <th width="">Student NO.</th>
                            <th width="">Department</th>
                            <th width="">Date Start</th>
                            <th width="">Date End</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($education as $edu)
                            <tr>
                                <td>{{ $edu->id}}</td>
                                <td>{{ $edu->user->name}} </td>
                                <td>{{ $edu->student_number }} </td>
                                <td>{{ $edu->depart->depart_fullName }}</td>
                                <td>{{ $edu->education_start }} </td>
                                <td>{{ $edu->education_end}} </td>
                                <td style="display: flex">
                                    <a href="{{-- route('posts.show',$edu->id) --}}"
                                        class="btn btn-primary m-2">Show
                                    </a>
                                    <a href="{{-- route('posts.edit', $edu->id) --}}"
                                        class="btn btn-warning  m-2">Edit
                                    </a>
                                    <form method="POST" action="{{-- route('posts.delete', $edu->id) --}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            Delete
                                        </button>
                                   </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--$education->links('pagination::bootstrap-5')--}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
