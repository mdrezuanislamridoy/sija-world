@extends('user.layout')

@section('title', 'My Orders - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))
@section('page_title', 'My Orders')

@section('user_content')
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">
        <i class="fa fa-list-alt text-primary mr-2"></i> All Orders ({{ $orders->total() }})
    </h5>

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Order #</th>
                        <th>Items</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-weight-bold text-dark">{{ $order->order_number }}</td>
                            <td>{{ $order->items->count() }} item(s)</td>
                            <td class="text-muted small">{{ $order->created_at->format('d M, Y h:i A') }}</td>
                            <td class="font-weight-bold text-primary">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->grand_total) }}</td>
                            <td><span class="badge badge-light border">{{ $order->payment_method }}</span></td>
                            <td>
                                @if($order->order_status == 'Delivered')
                                    <span class="badge badge-success">Delivered</span>
                                @elseif($order->order_status == 'Shipped')
                                    <span class="badge badge-info">Shipped</span>
                                @elseif($order->order_status == 'Processing')
                                    <span class="badge badge-warning">Processing</span>
                                @elseif($order->order_status == 'Cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @else
                                    <span class="badge badge-secondary">Pending</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('user.orders.details', $order->order_number) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye mr-1"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="text-center py-5 text-muted">
            <i class="fa fa-shopping-basket fa-4x mb-3 d-block text-muted"></i>
            <h4>No orders found.</h4>
            <p>Your previous purchase history will appear here once you place an order.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
