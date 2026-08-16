@extends('layouts.app')

@section('title', 'Customer Login - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="auth-page-area py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow rounded-lg p-4 p-md-5 bg-white">
                    <div class="text-center mb-4">
                        <img src="{{ asset($globalSetting->logo ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png') }}" alt="{{ $globalSetting->site_name ?? 'Miswan Fashion' }}" style="max-height: 45px;" class="mb-3">
                        <h4 class="font-weight-bold text-dark mb-1">Welcome Back!</h4>
                        <p class="text-muted small">Sign in to track orders and manage your account.</p>
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

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Phone Number or Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="login" class="form-control" placeholder="017XXXXXXXX or email" value="{{ old('login') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Enter password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-light border" type="button" onclick="togglePasswordVisibility('loginPassword', this)"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember">
                                <label class="custom-control-label small text-muted cursor-pointer" for="rememberMe">Remember Me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold shadow-sm mb-3">
                            <i class="fa fa-sign-in mr-1"></i> Sign In
                        </button>

                        <div class="text-center border-top pt-3">
                            <p class="text-muted small m-0">Don't have an account yet? <a href="{{ route('register') }}" class="font-weight-bold text-primary">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(fieldId, btn) {
        var field = document.getElementById(fieldId);
        var icon = btn.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
