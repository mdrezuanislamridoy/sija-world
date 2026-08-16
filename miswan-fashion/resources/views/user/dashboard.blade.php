@extends('user.layout')

@section('title', 'My Dashboard - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))
@section('page_title', 'Dashboard')

@section('user_content')
<!-- Metric Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Total Orders Placed</h6>
            <h3 class="font-weight-bold text-primary m-0">{{ $totalOrdersCount }}</h3>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Registered Phone</h6>
            <h6 class="font-weight-bold text-dark m-0">{{ $user->phone }}</h6>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Default City</h6>
            <h6 class="font-weight-bold text-dark m-0">{{ $user->district ?? 'Dhaka' }}</h6>
        </div>
    </div>
</div>

<!-- Recent Orders Card -->
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0"><i class="fa fa-shopping-bag text-primary mr-2"></i> Recent Orders</h5>
        <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary">View All Orders</a>
    </div>

    @if(isset($recentOrders) && $recentOrders->count() > 0)
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td class="font-weight-bold text-dark">{{ $order->order_number }}</td>
                            <td class="text-muted small">{{ $order->created_at->format('d M, Y') }}</td>
                            <td class="font-weight-bold text-primary">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($order->grand_total) }}</td>
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
                                <a href="{{ route('user.orders.details', $order->order_number) }}" class="btn btn-sm btn-light border">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4 text-muted">
            <i class="fa fa-shopping-bag fa-3x mb-2 d-block text-muted"></i>
            <p>You haven't placed any orders yet.</p>
            <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
