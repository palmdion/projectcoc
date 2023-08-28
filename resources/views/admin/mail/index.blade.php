@extends('admin.index')

@section('title', 'Article Shipment ')

@section('content')

<div class="container-fluid p-3">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Article Shipment </h1>
    </div>

    {{-- Alert Messages --}}
    @include('admin.alert')

    <form action="{{ route('mail.sendMail') }}" method="post"  enctype="multipart/form-data" >
        @csrf
        <div class="form-group mt-2">
            <label class="mb-2" for="name">ชื่อผู้ส่ง</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text"
                        placeholder="Name"
                        name="name"
                        value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label class="mb-2" for="name">เมลผู้รับ</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email"
                        placeholder="Email address"
                        name="email"
                        value="{{ old('email') }}">
            @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label class="mb-2" for="subject">หัวเรื่อง</label>
            <input class="form-control @error('subject') is-invalid @enderror" type="text"
                        placeholder="Subject"
                        name="subject"
                        value="{{ old('subject') }}">
            @error('subject')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
       
        <!-- Message -->
        <div class="form-group mt-2">
            <label for="message" class="form-label ">อธิบายรายละเอียด</label>
            <textarea id="summernote" class="form-control" style="height:150px auto" name="message" placeholder="อธิบายกิจกรรม"
                ></textarea>
            @error('message')
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
        <!-- END Message -->
        <button class="btn btn-primary mt-2" type="submit">ส่งเมล    </button>
    </form>
</div>



@endsection

@section('scripts')

@endsection
