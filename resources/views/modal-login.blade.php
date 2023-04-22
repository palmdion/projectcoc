<!-- Button Login Modal -->
<button type="button" class="btn btn-outline-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
    {{ 'เข้าสู่ระบบ' }}
</button>
<!-- Modal -->
<div class="modal fade modal-mb" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login"
                    type="button" role="tab" aria-controls="pills-login" aria-selected="true">{{ __('เข้าสู่ระบบ') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register"
                    type="button" role="tab" aria-controls="pills-register" aria-selected="false">{{ __('ลงทะเบียน') }}</button>
                </li>
            </ul>
            <br>
            <div class="tab-content text-center " id="pills-tabContent">
                @if (Route::has('login'))
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                        <div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <!--Input Email-->
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>
                                    <label for="email" >กรอกอีเมล</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                 <!--Input Password-->
                                 <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="password" value="{{ old('password') }}"
                                    required autocomplete="current-password" required>
                                    <label for="password" >กรอกรหัสผ่าน</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Forgot Password
                                <div class="text-center">
                                    <div class="mb-3">
                                        @if (Route::has('password.request'))
                                            <a class="nav nav-link fw-semibold" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>-->

                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary btn-block w-100">{{ __('เข้าสู่ระบบ') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="tab-pane fade m-3" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                        <div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <!--Input Name-->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="name" value="{{ old('name') }}"
                                    required autocomplete="name" required>
                                    <label for="name">ชื่อ</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--Input Name-->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" placeholder="last_name" value="{{ old('last_name') }}"
                                    required autocomplete="last_name" required>
                                    <label for="name">นามสกุล</label>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!--Input Mail-->
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="email" value="{{ old('email') }}"
                                    required autocomplete="email" required>
                                    <label for="email">อีเมล</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!--Input Password-->
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="password"  value="{{ old('email') }}"
                                    required autocomplete="new-password" required>
                                    <label for="password">รหัสผ่าน</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!--Input Password-confirm-->
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control"
                                    id="password-confirm" name="password_confirmation" placeholder="password_confirmation" value="{{ old('email') }}"
                                    required autocomplete="new-password" required>
                                    <label for="password-confirm">ยืนยันรหัสผ่าน</label>
                                </div>
                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-mb-6">
                                        <button type="submit" class="btn btn-primary btn-block w-100">ลงทะเบียน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">กลับ</button>
        </div>
    </div>
    </div>
</div>
