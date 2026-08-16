@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page_title', 'Analytics & Store Overview')

@section('admin_content')
<!-- Metrics Overview -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white border-left border-primary" style="border-left-width: 4px !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small mb-1">TOTAL REVENUE</h6>
                    <h4 class="font-weight-bold text-dark m-0">TK {{ number_format($totalRevenue) }}</h4>
                </div>
                <div class="bg-light text-primary rounded p-3"><i class="fa fa-money fa-2x"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white border-left border-success" style="border-left-width: 4px !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small mb-1">TOTAL ORDERS</h6>
                    <h4 class="font-weight-bold text-dark m-0">{{ $totalOrders }}</h4>
                </div>
                <div class="bg-light text-success rounded p-3"><i class="fa fa-shopping-cart fa-2x"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white border-left border-info" style="border-left-width: 4px !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small mb-1">TOTAL PRODUCTS</h6>
                    <h4 class="font-weight-bold text-dark m-0">{{ $totalProducts }}</h4>
                </div>
                <div class="bg-light text-info rounded p-3"><i class="fa fa-cube fa-2x"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white border-left border-warning" style="border-left-width: 4px !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small mb-1">TOTAL USERS</h6>
                    <h4 class="font-weight-bold text-dark m-0">{{ $totalUsers }}</h4>
                </div>
                <div class="bg-light text-warning rounded p-3"><i class="fa fa-users fa-2x"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Order Status Metrics -->
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-warning text-dark">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-clock-o mr-1"></i> Pending Orders: {{ $pendingOrders }}</h6>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-info text-white">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-cogs mr-1"></i> Processing Orders: {{ $processingOrders }}</h6>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-success text-white">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-check-circle mr-1"></i> Delivered Orders: {{ $deliveredOrders }}</h6>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">Recent Customer Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All Orders</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>District</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td class="font-weight-bold text-dark">{{ $order->order_number }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->district }}</td>
                        <td class="font-weight-bold text-primary">TK {{ number_format($order->grand_total) }}</td>
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
                        <td><span class="badge badge-light border">{{ $order->payment_method }}</span></td>
                        <td class="text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No orders available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
