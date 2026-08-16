@extends('admin.layout')

@section('title', 'Manage Orders')
@section('page_title', 'Customer Orders')

@section('admin_content')
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">Customer Orders</h5>

        <!-- Filter Status Tabs -->
        <div class="btn-group btn-group-sm">
            <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="btn {{ $status == 'all' ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
            <a href="{{ route('admin.orders.index', ['status' => 'Pending']) }}" class="btn {{ $status == 'Pending' ? 'btn-secondary' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'Processing']) }}" class="btn {{ $status == 'Processing' ? 'btn-warning' : 'btn-outline-warning' }}">Processing</a>
            <a href="{{ route('admin.orders.index', ['status' => 'Shipped']) }}" class="btn {{ $status == 'Shipped' ? 'btn-info' : 'btn-outline-info' }}">Shipped</a>
            <a href="{{ route('admin.orders.index', ['status' => 'Delivered']) }}" class="btn {{ $status == 'Delivered' ? 'btn-success' : 'btn-outline-success' }}">Delivered</a>
            <a href="{{ route('admin.orders.index', ['status' => 'Cancelled']) }}" class="btn {{ $status == 'Cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">Cancelled</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>District</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="font-weight-bold text-dark">{{ $order->order_number }}</td>
                        <td class="text-muted small">{{ $order->created_at->format('d M, Y') }}</td>
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
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-eye mr-1"></i> Manage</a>
                            <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="d-inline" onsubmit="return confirm('Delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No orders found in this category.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
