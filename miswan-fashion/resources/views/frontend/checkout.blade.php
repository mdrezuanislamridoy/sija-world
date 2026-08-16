@extends('layouts.app')

@section('title', 'Secure Checkout - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="checkout-page-area py-5 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <h6 class="font-weight-bold mb-2"><i class="fa fa-exclamation-triangle"></i> অনুগ্রহ করে নিচের তথ্যগুলো পূরণ করুন:</h6>
                <ul class="m-0 pl-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.order') }}" id="checkoutOrderForm">
            @csrf
            <div class="row">
                <!-- Delivery & Customer Information Form -->
                <div class="col-lg-7 mb-4">
                    <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                        <h4 class="font-weight-bold text-dark mb-4 border-bottom pb-2">
                            <i class="fa fa-map-marker text-primary mr-2"></i> ডেলিভারি ও কাস্টমার তথ্য
                        </h4>

                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark">আপনার নাম <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control form-control-lg" placeholder="আপনার সম্পূর্ণ নাম লিখুন" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required>
                        </div>

                        <!-- Phone & Alt Phone -->
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" id="customer_phone" class="form-control form-control-lg" placeholder="017XXXXXXXX" value="{{ old('phone', Auth::user()->phone ?? '') }}" required pattern="^(?:\+?88)?01[3-9][0-9]{8}$">
                                <small class="text-muted">সঠিক ১১ ডিজিটের মোবাইল নম্বর দিন</small>
                            </div>
                            <!-- <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark">বিকল্প মোবাইল নম্বর (ঐচ্ছিক)</label>
                                <input type="tel" name="alt_phone" class="form-control form-control-lg" placeholder="01XXXXXXXXX" value="{{ old('alt_phone') }}">
                            </div> -->
                        </div>

                        <!-- District (Location) with AJAX Shipping Cost -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark">আপনার এরিয়া নির্বাচন করুন <span class="text-danger">*</span></label>
                            <select name="district_id" id="districtSelect" class="form-control form-control-lg select2-enable" required>
                                <option value="" disabled selected>-- এরিয়া নির্বাচন করুন --</option>
                                <option value="inside_dhaka" data-cost="80" {{ old('district_id') == 'inside_dhaka' ? 'selected' : '' }}>ঢাকার ভিতরে - ডেলিভারি চার্জ: {{ $globalSetting->currency_symbol ?? 'TK' }} 80</option>
                                <option value="outside_dhaka" data-cost="130" {{ old('district_id') == 'outside_dhaka' ? 'selected' : '' }}>ঢাকার বাইরে - ডেলিভারি চার্জ: {{ $globalSetting->currency_symbol ?? 'TK' }} 130</option>
                            </select>
                        </div>

                        <!-- Upazila / Thana -->
                        <!-- <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark">থানা / উপজেলা (ঐচ্ছিক)</label>
                            <input type="text" name="upazila" class="form-control" placeholder="যেমন: ধানমন্ডি / মিরপুর / সদর" value="{{ old('upazila', Auth::user()->upazila ?? '') }}">
                        </div> -->

                        <!-- Full Delivery Address -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark">সম্পূর্ণ ডেলিভারি ঠিকানা <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" placeholder="বাসা নম্বর, রোড নম্বর, এলাকা বা গ্রামের নাম বিস্তারিত লিখুন..." required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        </div>

                        <!-- Order Notes -->
                        <!-- <div class="form-group mb-0">
                            <label class="font-weight-bold text-dark">অর্ডার নোট / বিশেষ নির্দেশনা (ঐচ্ছিক)</label>
                            <textarea name="order_notes" class="form-control" rows="2" placeholder="ডেলিভারি সংক্রান্ত কোনো বিশেষ বার্তা থাকলে এখানে লিখতে পারেন...">{{ old('order_notes') }}</textarea>
                        </div> -->
                    </div>
                </div>

                <!-- Order Review & Payment Selection Sidebar -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
                        <h4 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                            <i class="fa fa-list-alt text-primary mr-2"></i> অর্ডার বিবরণী
                        </h4>

                        <!-- Items List -->
                        <div class="checkout-items-list mb-3" style="max-height: 250px; overflow-y: auto;">
                            @foreach($cart as $item)
                                <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image'] ?? 'assets/ecommerce/dist/images/default.png') }}" class="rounded mr-2 border" width="45" height="45" style="object-fit: cover;">
                                        <div>
                                            <h6 class="font-weight-bold text-dark m-0 text-truncate" style="max-width: 170px; font-size: 13px;">{{ $item['name'] }}</h6>
                                            @if(!empty($item['variant_name']))
                                                <small class="text-muted">{{ $item['variant_name'] }}</small><br>
                                            @endif
                                            <small class="text-muted">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item['price']) }} &times; {{ $item['quantity'] }}</small>
                                        </div>
                                    </div>
                                    <span class="font-weight-bold text-dark">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item['price'] * $item['quantity']) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Calculation Breakdown -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">পণ্য মূল্য (Subtotal):</span>
                            <span class="font-weight-bold text-dark">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($subtotal) }}</span>
                        </div>

                        @if($discount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>কুপন ডিসকাউন্ট:</span>
                                <span class="font-weight-bold">- {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($discount) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">ডেলিভারি চার্জ:</span>
                            <span class="font-weight-bold text-dark" id="displayShippingCost">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($shippingCost) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4 border-top pt-3">
                            <span class="font-weight-bold h5 m-0 text-dark">সর্বমোট প্রদেয় টাকা:</span>
                            <span class="font-weight-bold h4 m-0 text-danger" id="displayGrandTotal">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($grandTotal) }}</span>
                        </div>

                        <!-- Payment Methods -->
                        <h5 class="font-weight-bold text-dark mb-3 border-top pt-3">পেমেন্ট মেথড</h5>
                        <div class="payment-options mb-4">
                            <div class="custom-control custom-radio mb-2 p-2 border rounded">
                                <input type="radio" id="payment_cod" name="payment_method" value="Cash on Delivery" class="custom-control-input" checked>
                                <label class="custom-control-label font-weight-bold text-dark cursor-pointer d-flex align-items-center justify-content-between w-100" for="payment_cod">
                                    <span><i class="fa fa-money text-success mr-2"></i> ক্যাশ অন ডেলিভারি (Cash on Delivery)</span>
                                </label>
                            </div>
<!-- 
                            <div class="custom-control custom-radio mb-2 p-2 border rounded">
                                <input type="radio" id="payment_online" name="payment_method" value="Online Payment" class="custom-control-input">
                                <label class="custom-control-label font-weight-bold text-dark cursor-pointer d-flex align-items-center justify-content-between w-100" for="payment_online">
                                    <span><i class="fa fa-credit-card text-primary mr-2"></i> bKash / Nagad / Card</span>
                                </label>
                            </div> -->
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-3 font-weight-bold shadow-lg" id="placeOrderSubmitBtn" style="font-size: 17px;">
                            <i class="fa fa-check-circle mr-1"></i> অর্ডার সম্পন্ন করুন (Confirm Order)
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#districtSelect').on('change', function() {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: "{{ route('checkout.shipping') }}",
                    method: "POST",
                    data: { district_id: districtId },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#displayShippingCost').text(res.shipping_formatted);
                            $('#displayGrandTotal').text(res.grand_total_formatted);
                        }
                    }
                });
            }
        });

        $('#checkoutOrderForm').on('submit', function() {
            var $btn = $('#placeOrderSubmitBtn');
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> অর্ডার প্রক্রিয়াধীন...');
        });
    });
</script>
@endpush
