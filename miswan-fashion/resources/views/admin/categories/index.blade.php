@extends('admin.layout')

@section('title', 'Manage Categories')
@section('page_title', 'Category Management')

@section('admin_content')
<div class="row">
    <!-- Category List -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Active Categories</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products Count</th>
                            <th>Priority</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td>
                                    <img src="{{ asset($cat->image) }}" width="40" height="40" class="rounded-circle border" style="object-fit: cover;">
                                </td>
                                <td class="font-weight-bold text-dark">{{ $cat->name }}</td>
                                <td><code>{{ $cat->slug }}</code></td>
                                <td><span class="badge badge-primary">{{ $cat->products_count }} items</span></td>
                                <td>{{ $cat->priority }}</td>
                                <td class="text-right">
                                    <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Category</h5>

            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Premium Watch" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control-file" accept="image/*" required>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold small">Sort Priority</label>
                    <input type="number" name="priority" class="form-control" value="1">
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-plus mr-1"></i> Add Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
