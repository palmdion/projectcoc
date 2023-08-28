@extends('profile.detail')

@section('title', 'Work')

@section('contentProfile')

    <!-- Alert Messages -->
    @include('admin.alert')
    <div class="d-flex ">
        <div><a class="btn btn-primary  " href="{{ route('profile.proEditWork') }}">เพิ่มอาชีพการทำงาน</a></div>
    </div>
    <br>
    <div>
        <div class="mb-3">
            <span>
                <h4 id="textF">ข้อมูลอาชีพการทำงาน</h4>
            </span>
        </div>
        <div>
            <table class="table">
                <thead id="textF">
                    <tr>
                        <th>อาชีพ</th>
                        <th>สถานที่ทำงาน</th>
                        <th>อธิบายรายละเอียด</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="textL">
                    @foreach ($work as $workM)
                        <tr>
                            <td>{{ $workM->work_name }}</td>
                            <td>{{ $workM->company_name }}</td>
                            <td>{!! $workM->description !!}</td>
                            <td class="d-flex ">
                                <a class="btn btn-warning m-2"
                                    href="{{ route('profile.editWork', $workM->id) }}">แก้ไข</a>
                                <form method="POST" action="{{ route('profile.deleteWork', $workM->id) }}">
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

        </div>
    </div>

@endsection
