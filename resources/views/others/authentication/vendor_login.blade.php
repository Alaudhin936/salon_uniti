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
                            <form class="theme-form" method="POST" action="{{ route('salonWebLogin') }}">
                                @csrf


                                <div class="form-group">
                                    <label class="col-form-label">Email Mobile Number</label>
                                    <input class="form-control" type="text" name="ph_number"
                                           required autofocus placeholder="9976525811">
                                    @error('ph_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>



                                {{-- Remember Me & Forgot Password --}}
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Get Otp</button>
                                    </div>
                                </div>

                                {{-- Social Logins (Optional) --}}
                                <div class="login-social-title">
                                    <h6>Or Sign in with</h6>
                                </div>
                                <div class="form-group">
                                    <ul class="login-social">
                                        <li><a href="#"><i data-feather="linkedin"></i></a></li>
                                        <li><a href="#"><i data-feather="twitter"></i></a></li>
                                        <li><a href="#"><i data-feather="facebook"></i></a></li>
                                        <li><a href="#"><i data-feather="instagram"></i></a></li>
                                    </ul>
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
