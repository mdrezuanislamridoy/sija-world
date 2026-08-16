@extends('layouts.app')

@section('title', $page->title . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="static-page-area py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm rounded-lg p-4 p-md-5 bg-white">
            <h1 class="font-weight-bold text-dark mb-4 border-bottom pb-3">{{ $page->title }}</h1>
            <div class="page-body text-muted" style="line-height: 1.8; font-size: 15px;">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
