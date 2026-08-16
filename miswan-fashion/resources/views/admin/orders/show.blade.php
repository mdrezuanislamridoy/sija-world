@extends('admin.layout')

@section('title', 'Manage Order #' . $order->order_number)
@section('page_title', 'Order #' . $order->order_number)

@section('admin_content')
<div class="row">
    <!-- Main Order Details -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h5 class="font-weight-bold text-dark m-0">Order Products ({{ $order->items->count() }})</h5>
                <span class="badge badge-light border font-weight-bold">Date: {{ $order->created_at->format('d M, Y h:i A') }}</span>
            </div>

            <div class="table-responsive mb-3">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Item</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->product_image ?? 'assets/ecommerce/dist/images/default.png') }}" width="45" height="45" class="rounded mr-2 border" style="object-fit: cover;">
                                        <div>
                                            <h6 class="font-weight-bold text-dark m-0">{{ $item->product_name }}</h6>
                                            @if($item->variant_name)
                                                <small class="text-muted">Size: {{ $item->variant_name }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-dark font-weight-bold">TK {{ number_format($item->price) }}</td>
                                <td class="text-center font-weight-bold">{{ $item->quantity }}</td>
                                <td class="text-right font-weight-bold text-primary">TK {{ number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Subtotal:</th>
                            <th class="text-right">TK {{ number_format($order->subtotal) }}</th>
                        </tr>
                        @if($order->discount > 0)
                            <tr>
                                <th colspan="3" class="text-right text-success">Discount:</th>
                                <th class="text-right text-success">- TK {{ number_format($order->discount) }}</th>
                            </tr>
                        @endif
                        <tr>
                            <th colspan="3" class="text-right">Shipping Delivery Fee:</th>
                            <th class="text-right">TK {{ number_format($order->shipping_cost) }}</th>
                        </tr>
                        <tr class="bg-light">
                            <th colspan="3" class="text-right font-weight-bold text-danger h5 m-0">Grand Total:</th>
                            <th class="text-right font-weight-bold text-danger h5 m-0">TK {{ number_format($order->grand_total) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left mr-1"></i> Back to Orders List</a>
                <a href="{{ route('order.success', $order->order_number) }}" target="_blank" class="btn btn-outline-dark btn-sm"><i class="fa fa-print mr-1"></i> Customer Invoice</a>
            </div>
        </div>
    </div>

    <!-- Sidebar Status & Customer Details -->
    <div class="col-lg-4">
        <!-- Status Updater Card -->
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Update Order Status</h5>

            <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Order Lifecycle Status</label>
                    <select name="order_status" class="form-control font-weight-bold">
                        <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold small">Payment Status</label>
                    <select name="payment_status" class="form-control font-weight-bold">
                        <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Refunded" {{ $order->payment_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-save mr-1"></i> Update Status</button>
            </form>
        </div>

        <!-- Customer Info Card -->
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Customer & Shipping</h5>
            <p class="m-0 text-muted small"><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p class="m-0 text-muted small"><strong>Primary Phone:</strong> <a href="tel:{{ $order->phone }}" class="font-weight-bold">{{ $order->phone }}</a></p>
            @if($order->alt_phone)
                <p class="m-0 text-muted small"><strong>Alt Phone:</strong> {{ $order->alt_phone }}</p>
            @endif
            <p class="m-0 text-muted small"><strong>District:</strong> {{ $order->district }} @if($order->upazila) ({{ $order->upazila }}) @endif</p>
            <p class="m-0 text-muted small"><strong>Address:</strong> {{ $order->address }}</p>
            <p class="m-0 text-muted small"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            @if($order->order_notes)
                <div class="mt-2 p-2 bg-light rounded text-muted small">
                    <strong>Customer Note:</strong> {{ $order->order_notes }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
