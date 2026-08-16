@extends('user.layout')

@section('title', 'Profile Settings - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))
@section('page_title', 'Profile Settings')

@section('user_content')
<div class="row">
    <!-- Profile Info Card -->
    <div class="col-lg-7 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                <i class="fa fa-user text-primary mr-2"></i> Personal Details
            </h5>

            @if(session('profile_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('profile_success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
            @endif

            <form method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold text-dark small">Mobile Number</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->phone }}" readonly>
                        <small class="text-muted">Phone number cannot be altered</small>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold text-dark small">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold text-dark small">Default District</label>
                        <input type="text" name="district" class="form-control" value="{{ old('district', $user->district) }}" placeholder="e.g. Dhaka">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold text-dark small">Thana / Upazila</label>
                        <input type="text" name="upazila" class="form-control" value="{{ old('upazila', $user->upazila) }}" placeholder="e.g. Dhanmondi">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark small">Default Delivery Address</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Enter house, road, area...">{{ old('address', $user->address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm">
                    <i class="fa fa-save mr-1"></i> Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Password Change Card -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                <i class="fa fa-lock text-primary mr-2"></i> Change Password
            </h5>

            @if(session('password_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('password_success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
            @endif

            @if(isset($errors) && ($errors->has('current_password') || $errors->has('new_password')))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="m-0 pl-3 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
            @endif

            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small">Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark small">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Min 6 characters" required>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark small">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Repeat new password" required>
                </div>

                <button type="submit" class="btn btn-dark btn-block py-2 font-weight-bold shadow-sm">
                    <i class="fa fa-key mr-1"></i> Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
