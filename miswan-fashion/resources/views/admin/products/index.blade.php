@extends('admin.layout')

@section('title', 'Manage Products')
@section('page_title', 'Products Catalog')

@section('admin_content')
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">All Products ({{ $products->total() }})</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i> Add New Product</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $prod)
                    <tr>
                        <td>
                            <img src="{{ asset($prod->thumbnail) }}" width="45" height="45" class="rounded border" style="object-fit: cover;">
                        </td>
                        <td class="font-weight-bold text-dark">{{ $prod->name }}</td>
                        <td><code>{{ $prod->sku }}</code></td>
                        <td><span class="badge badge-light border">{{ $prod->category->name ?? 'None' }}</span></td>
                        <td class="font-weight-bold text-primary">TK {{ number_format($prod->price) }}</td>
                        <td>
                            <span class="badge {{ $prod->stock > 0 ? 'badge-success' : 'badge-danger' }}">{{ number_format($prod->stock) }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $prod->status ? 'badge-success' : 'badge-secondary' }}">{{ $prod->status ? 'Active' : 'Hidden' }}</span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-sm btn-info mr-1"><i class="fa fa-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.products.destroy', $prod->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
