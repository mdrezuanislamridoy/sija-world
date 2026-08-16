@extends('layouts.app')

@section('title', 'Contact Us - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="contact-page-area py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white h-100">
                    <h2 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Get in Touch</h2>
                    <p class="text-muted mb-4">Have questions about your order, tracking, or bulk inquiries? Contact our customer support team.</p>

                    <div class="info-block d-flex align-items-start mb-4">
                        <div class="icon-box bg-primary text-white rounded p-3 mr-3"><i class="fa fa-map-marker fa-lg"></i></div>
                        <div>
                            <h6 class="font-weight-bold text-dark m-0">Corporate Office</h6>
                            <p class="text-muted m-0">{{ $setting->address ?? 'Dhaka, Bangladesh' }}</p>
                        </div>
                    </div>

                    <div class="info-block d-flex align-items-start mb-4">
                        <div class="icon-box bg-primary text-white rounded p-3 mr-3"><i class="fa fa-phone fa-lg"></i></div>
                        <div>
                            <h6 class="font-weight-bold text-dark m-0">Customer Support Hotline</h6>
                            <p class="text-muted m-0">{{ $setting->phone ?? '+8801700000000' }}</p>
                        </div>
                    </div>

                    <div class="info-block d-flex align-items-start mb-4">
                        <div class="icon-box bg-primary text-white rounded p-3 mr-3"><i class="fa fa-envelope fa-lg"></i></div>
                        <div>
                            <h6 class="font-weight-bold text-dark m-0">Support Email</h6>
                            <p class="text-muted m-0">{{ $setting->email ?? 'support@miswanfashion.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h3 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Send us a Message</h3>
                    <form onsubmit="event.preventDefault(); alertify.success('Thank you for contacting us! We will get back to you shortly.'); this.reset();">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Your Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required placeholder="Enter full name">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required placeholder="017XXXXXXXX">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Subject</label>
                            <input type="text" class="form-control" placeholder="Subject of inquiry">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Your Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="5" required placeholder="Write your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold"><i class="fa fa-paper-plane mr-1"></i> Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
