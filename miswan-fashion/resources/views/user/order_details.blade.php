@extends('user.layout')

@section('title', 'Order #' . $order->order_number . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))
@section('page_title', 'Order #' . $order->order_number)

@section('user_content')
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h5 class="font-weight-bold text-dark m-0">Order <span class="text-primary">#{{ $order->order_number }}</span></h5>
            <small class="text-muted">Placed on {{ $order->created_at->format('d F, Y \a\t h:i A') }}</small>
        </div>
        <div>
            <button class="btn btn-sm btn-dark" onclick="window.print()"><i class="fa fa-print mr-1"></i> Print Invoice</button>
        </div>
    </div>

    <!-- Order Tracking Status Stepper -->
    <div class="order-stepper-wrapper p-3 bg-light rounded mb-4">
        <div class="d-flex justify-content-between text-center">
            <div class="step-item {{ in_array($order->order_status, ['Pending', 'Processing', 'Shipped', 'Delivered']) ? 'text-success font-weight-bold' : 'text-muted' }}">
                <i class="fa fa-check-circle fa-2x d-block mb-1"></i>
                <small>Order Placed</small>
            </div>
            <div class="step-item {{ in_array($order->order_status, ['Processing', 'Shipped', 'Delivered']) ? 'text-success font-weight-bold' : 'text-muted' }}">
                <i class="fa fa-cogs fa-2x d-block mb-1"></i>
                <small>Processing</small>
            </div>
            <div class="step-item {{ in_array($order->order_status, ['Shipped', 'Delivered']) ? 'text-success font-weight-bold' : 'text-muted' }}">
                <i class="fa fa-truck fa-2x d-block mb-1"></i>
                <small>Shipped</small>
            </div>
            <div class="step-item {{ $order->order_status == 'Delivered' ? 'text-success font-weight-bold' : 'text-muted' }}">
                <i class="fa fa-home fa-2x d-block mb-1"></i>
                <small>Delivered</small>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="p-3 border rounded h-100">
                <h6 class="font-weight-bold text-dark mb-2">Delivery Address</h6>
                <p class="m-0 text-muted small"><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p class="m-0 text-muted small"><strong>Phone:</strong> {{ $order->phone }}</p>
                <p class="m-0 text-muted small"><strong>Address:</strong> {{ $order->address }}</p>
                <p class="m-0 text-muted small"><strong>City / District:</strong> {{ $order->district }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 border rounded h-100">
                <h6 class="font-weight-bold text-dark mb-2">Payment Details</h6>
                <p class="m-0 text-muted small"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                <p class="m-0 text-muted small"><strong>Payment Status:</strong> <span class="badge badge-info">{{ $order->payment_status }}</span></p>
                <p class="m-0 text-muted small"><strong>Order Status:</strong> <span class="badge badge-primary">{{ $order->order_status }}</span></p>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($item->product_image ?? 'assets/ecommerce/dist/images/default.png') }}" class="rounded mr-2 border" width="40" height="40" style="object-fit: cover;">
                                <div>
                                    <span class="font-weight-bold text-dark">{{ $item->product_name }}</span>
                                    @if($item->variant_name)
                                        <br><small class="text-muted">Size: {{ $item->variant_name }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-dark">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item->price) }}</td>
                        <td class="text-center font-weight-bold text-dark">{{ $item->quantity }}</td>
                        <td class="text-right font-weight-bold text-dark">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Subtotal:</th>
                    <th class="text-right">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->subtotal) }}</th>
                </tr>
                @if($order->discount > 0)
                    <tr>
                        <th colspan="3" class="text-right text-success">Discount:</th>
                        <th class="text-right text-success">- {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->discount) }}</th>
                    </tr>
                @endif
                <tr>
                    <th colspan="3" class="text-right">Shipping Cost:</th>
                    <th class="text-right">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->shipping_cost) }}</th>
                </tr>
                <tr class="bg-light">
                    <th colspan="3" class="text-right font-weight-bold text-danger h5 m-0">Grand Total:</th>
                    <th class="text-right font-weight-bold text-danger h5 m-0">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->grand_total) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
        <a href="{{ route('user.orders') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left mr-1"></i> Back to Orders</a>
    </div>
</div>
@endsection
