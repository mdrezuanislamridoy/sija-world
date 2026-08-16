@extends('layouts.app')

@section('title', 'My Wishlist - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="wishlist-page-area py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h2 class="font-weight-bold text-dark mb-4 border-bottom pb-2"><i class="fa fa-heart text-danger mr-2"></i> My Wishlist</h2>
            <div class="text-center py-5">
                <i class="fa fa-heart-o fa-4x text-muted mb-3 d-block"></i>
                <h4 class="font-weight-bold text-dark">Your Wishlist is currently empty</h4>
                <p class="text-muted">Browse our trending catalog and save items you love!</p>
                <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2 font-weight-bold mt-2">Explore Products</a>
            </div>
        </div>
    </div>
</div>
@endsection
