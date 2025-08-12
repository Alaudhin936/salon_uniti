@extends('others.others_layout.master')

@section('others_css')
@endsection

@section('others_content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div>
                        <a class="logo" href="{{ route('dashboard') }}">
                            <h2>Salon Uniti</h2>
                        </a>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h4 class="text-center">Sign in to account</h4>
                                <p class="text-center">Enter your email & password to login</p>

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email"
                                           value="{{ old('email') }}"
                                           required autofocus placeholder="Test@gmail.com">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password"
                                               required placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Remember Me & Forgot Password --}}
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" name="remember">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                    </div>
                                </div>

                              
                                {{-- Sign Up Link --}}
                                <p class="mt-4 mb-0 text-center">Don't have account?
                                    <a class="ms-2" href="{{ route('sign_up') }}">Create Account</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('others_script')
@endsection
