@extends('welcome')

@section('title', 'Send Request')

@section('mainContent')

    <div class="container">

        <div class=" row row-cols-1 row-cols-md-2 g-5 justify-content-center ">
            <div class="card col-md-6">
                <!-- Alert Messages -->
                @include('admin.alert')
                <div class="text-center mt-3 mb-3">
                    <h2 id="textF">{{ 'ติดต่อเรา' }}</h2>
                </div>
                <div class="card-body ">
                    <form class="row row-cols-1 row-cols-md-1 g-3" method="POST"
                        action="{{ route('sendRequest.sendRequest') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- mail address -->
                        <div class="col-md">
                            <label for="mail_address" class="form-label">เมลติดต่อ</label>
                            <input type="email" class="form-control @error('mail_address') is-invalid @enderror"
                                id="mail_address" placeholder="mail address" name="mail_address"
                                value="{{ Auth::user()->email }}">
                            @error('mail_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- mobile number -->
                        <div class="col-md">
                            <label for="mobile_number" class="form-label">เบอร์โทรติดต่อ</label>
                            <input type="number" class="form-control @error('mobile_number') is-invalid @enderror"
                                id="mobile_number" placeholder="mobile number" name="mobile_number"
                                value="{{ old('mobile_number') }}">
                            @error('mobile_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- subject -->
                        <div class="col-md">
                            <label for="subject" class="form-label">หัวเรื่อง</label>
                            <input type="text" class="form-control  @error('subject') is-invalid @enderror"
                                id="post_title" placeholder="subject" name="subject" value="{{ old('subject') }}">
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="form-label">อธิบายรายละเอียด</label>
                            <textarea id="summernote" class="form-control" style="height:150px auto" name="description" placeholder="อธิบายกิจกรรม"
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


                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-post float-right mb-3">ส่งข้อมูล</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<br>
@endsection
@section('scripts')

@endsection
