@extends('admin.index')

@section('title', 'Show Request')

@section('content')

<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{  route('sendRequest.index') }}" class="btn btn-primary  waves-effect">กลับ</a>
    <br>
    <br>
    <div class="mt-3 mb-3">
        <h2 id="textF">การติดต่อ</h2>
    </div>

    <div class="card mb-3">
        <div class="card-body">
          <div class="mt-2">
            <label class="mb-1" id="textF">ชื่อ</label>
            <h5 class="card-title" id="textL">{{ $send->user->full_name }}</h5>
          </div>
          <div class="mt-1">
            <label class="mb-2" id="textF">เมลติดต่อ</label>
            <h5 class="card-title" id="textL">{{ $send->mail_address}}</h5>
          </div>
          <div class="mt-2">
            <label class="mb-1" id="textF">เบอร์ติดต่อ</label>
            <h5 class="card-title" id="textL">{{ $send->mobile_number}}</h5>
          </div>
          <div class="mt-2">
            <label class="mb-1" id="textF">หัวเรื่อง</label>
            <h5 class="card-title" id="textL">{{ $send->subject}}</h5>
          </div>
          <div class="mt-2">
            <label class="mb-1" id="textF">รายละเอียด</label>
            <h5 class="">{!! $send->description !!}</h5>
          </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

@endsection
