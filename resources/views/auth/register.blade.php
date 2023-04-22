@extends('auth.layouts.app')
@section('title', 'Register')
@section('content')

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div>
            <div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--Input Email-->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" placeholder="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>
                        <label for="email" >Email Address</label>
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
                        required autocomplete="current-password" autofocus>
                        <label for="password" >Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Forgot Password-->
                    <div class=" text-center ">
                        <div class="mb-3">
                            @if (Route::has('password.request'))
                            <a class="nav nav-link  fw-semibold" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary btn-block w-100">{{ __('SIGN IN') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <br><br><br><br>
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!--Input Name-->
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                 id="name" name="name" placeholder="name" value="{{ old('name') }}"
                 required autocomplete="name" autofocus>
                <label for="name">Name</label>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!--Input Mail-->
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                 id="email" name="email" placeholder="email" value="{{ old('email') }}"
                 required autocomplete="email" >
                <label for="email">Email Address</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!--Input Password-->
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                 id="password" name="password" placeholder="email" value="{{ old('email') }}"
                 required autocomplete="new-password" >
                <label for="password">Password</label>
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
                 required autocomplete="new-password" >
                <label for="password-confirm">Confirm Password</label>
            </div>

            <!-- Submit -->
            <div class="row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block w-100">SIGN UP</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
