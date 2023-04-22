@extends('admin.index')

@section('title', 'Work List')

@section('content')

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Management Work User</h1>
    </div>

    <div class="py-3">
        <a class="btn btn-primary" href="{{-- route('work.create') --}}">Add</a>
    </div>

    <!-- Alert Messages -->
    @include('admin.alert')

    <!-- ตารางข้อมูลการศึกษาขอผู้ใช้งาน -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Work</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="">Author</th>
                            <th width="">Category</th>
                            <th width="">Company</th>
                            <th width="">Description</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                            <tr>
                                <td>{{ $work->id}}</td>
                                <td>{{ $work->user->name}} </td>
                                <td>{{ $work->cateWork_id }} </td>
                                <td>{{ $work->company_name }}</td>
                                <td>{{ $work->description }} </td>
                                <td style="display: flex">
                                    <a href="{{-- route('work.show',$work->id) --}}"
                                        class="btn btn-primary m-2">Show
                                    </a>
                                    <a href="{{-- route('work.edit', $work->id) --}}"
                                        class="btn btn-warning  m-2">Edit
                                    </a>
                                    <form method="POST" action="{{-- route('work.delete', $work->id) --}}">
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
                {{$works->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
