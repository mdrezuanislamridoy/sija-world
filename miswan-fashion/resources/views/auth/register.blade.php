@extends('layouts.app')

@section('title', 'Create an Account - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="auth-page-area py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card border-0 shadow rounded-lg p-4 p-md-5 bg-white">
                    <div class="text-center mb-4">
                        <img src="{{ asset($globalSetting->logo ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png') }}" alt="{{ $globalSetting->site_name ?? 'Miswan Fashion' }}" style="max-height: 45px;" class="mb-3">
                        <h4 class="font-weight-bold text-dark mb-1">Create an Account</h4>
                        <p class="text-muted small">Join Miswan Fashion for faster checkout & tracking.</p>
                    </div>

                    @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="m-0 pl-3 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="Your full name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Mobile Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="tel" name="phone" class="form-control" placeholder="017XXXXXXXX" value="{{ old('phone') }}" required pattern="^(?:\+?88)?01[3-9][0-9]{8}$">
                            </div>
                            <small class="text-muted">Enter a valid 11-digit Bangladeshi mobile number</small>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Email Address (Optional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-- Password & Confirmation -->
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark small">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark small">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold shadow-sm mb-3">
                            <i class="fa fa-user-plus mr-1"></i> Register Account
                        </button>

                        <div class="text-center border-top pt-3">
                            <p class="text-muted small m-0">Already have an account? <a href="{{ route('login') }}" class="font-weight-bold text-primary">Login Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
