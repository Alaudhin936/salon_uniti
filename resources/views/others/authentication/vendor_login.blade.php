@extends('others.others_layout.master')

@section('others_css')
@endsection

@section('others_content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card" style="background: url({{asset('assets/images/login/login_bg.jpg')}})">
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
