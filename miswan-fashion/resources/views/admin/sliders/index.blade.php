@extends('admin.layout')

@section('title', 'Manage Sliders & Banners')
@section('page_title', 'Sliders & Dynamic Purchasable Banners')

@section('admin_content')
<div class="row">
    <div class="col-12 mb-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <ul class="nav nav-pills mb-3 border-bottom pb-2" id="bannerTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" id="sliders-tab" data-toggle="tab" href="#sliders" role="tab" aria-controls="sliders" aria-selected="true">
                    <i class="fa fa-images mr-1"></i> Hero Carousel Sliders ({{ $sliders->count() }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">
                    <i class="fa fa-ad mr-1"></i> Promotional Banners ({{ $banners->count() }})
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="tab-content" id="bannerTabsContent">
    <!-- TAB 1: HERO SLIDERS -->
    <div class="tab-pane fade show active" id="sliders" role="tabpanel" aria-labelledby="sliders-tab">
        <div class="row">
            <!-- Hero Sliders List -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Active Hero Sliders</h5>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Preview</th>
                                    <th>Title & Subtitle</th>
                                    <th>Linked Product</th>
                                    <th>Target Link</th>
                                    <th>Order</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($slider->image) }}" width="110" height="50" class="rounded border" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <strong class="text-dark d-block">{{ $slider->title }}</strong>
                                            @if($slider->subtitle)
                                                <small class="text-muted">{{ $slider->subtitle }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($slider->product)
                                                <span class="badge badge-success mb-1 d-inline-block"><i class="fa fa-shopping-cart mr-1"></i> {{ $slider->product->name }}</span>
                                                <small class="d-block text-primary font-weight-bold">TK {{ number_format($slider->product->price) }}</small>
                                            @else
                                                <span class="badge badge-secondary">No Product Linked</span>
                                            @endif
                                        </td>
                                        <td><code>{{ Str::limit($slider->link, 30) }}</code></td>
                                        <td><span class="badge badge-light border">{{ $slider->sort_order }}</span></td>
                                        <td class="text-right">
                                            <form method="POST" action="{{ route('admin.sliders.destroy', $slider->id) }}" class="d-inline" onsubmit="return confirm('Delete this hero slider?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No Hero Sliders found. Add one using the form on the right!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Create Hero Slider Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Hero Slider</h5>

                    <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Slider Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Exclusive Summer Collection" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Subtitle / Tagline</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Up to 50% OFF on Selected Items">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-primary">Link to Purchasable Product (Optional)</label>
                            <select name="product_id" class="form-control">
                                <option value="">-- No Specific Product (Custom URL) --</option>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }} (TK {{ number_format($prod->price) }})</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">If selected, customers can buy directly from the banner!</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Target Click Link (Custom URL)</label>
                            <input type="text" name="link" class="form-control" placeholder="/product-category/fashion-women">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="Shop Now" placeholder="Shop Now / Buy Now">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control-file" accept="image/*" required>
                            <small class="form-text text-muted">Recommended size: 1200x500px</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold small">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="1">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
                            <i class="fa fa-plus mr-1"></i> Save Hero Slider
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: PROMOTIONAL BANNERS -->
    <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
        <div class="row">
            <!-- Banners List -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Active Promotional Banners</h5>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Preview</th>
                                    <th>Position</th>
                                    <th>Title & Tagline</th>
                                    <th>Linked Product</th>
                                    <th>Target Link</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($banner->image) }}" width="110" height="50" class="rounded border" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            @if($banner->position === 'middle_banner')
                                                <span class="badge badge-info"><i class="fa fa-th-large mr-1"></i> Middle Section</span>
                                            @else
                                                <span class="badge badge-warning"><i class="fa fa-star mr-1"></i> Side Hero Promo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="text-dark d-block">{{ $banner->title }}</strong>
                                            @if($banner->subtitle)
                                                <small class="text-muted">{{ $banner->subtitle }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($banner->product)
                                                <span class="badge badge-success mb-1 d-inline-block"><i class="fa fa-shopping-cart mr-1"></i> {{ $banner->product->name }}</span>
                                                <small class="d-block text-primary font-weight-bold">TK {{ number_format($banner->product->price) }}</small>
                                            @else
                                                <span class="badge badge-secondary">No Product Linked</span>
                                            @endif
                                        </td>
                                        <td><code>{{ Str::limit($banner->link, 30) }}</code></td>
                                        <td class="text-right">
                                            <form method="POST" action="{{ route('admin.banners.destroy', $banner->id) }}" class="d-inline" onsubmit="return confirm('Delete this promo banner?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No Promotional Banners found. Add one using the form on the right!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Create Banner Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Promo Banner</h5>

                    <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Banner Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Special Discount 20% OFF" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Subtitle / Tagline</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Best Sellers of the Season">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Banner Position <span class="text-danger">*</span></label>
                            <select name="position" class="form-control" required>
                                <option value="middle_banner">Middle Section Promo Banner</option>
                                <option value="top_banner">Top Right Side Banner (Next to Carousel)</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-primary">Link to Purchasable Product (Optional)</label>
                            <select name="product_id" class="form-control">
                                <option value="">-- No Specific Product (Custom Link) --</option>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }} (TK {{ number_format($prod->price) }})</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">If selected, customers can click to purchase instantly!</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Target Click Link (Custom URL)</label>
                            <input type="text" name="link" class="form-control" placeholder="/product-category/fashion-women">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small">Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="Buy Now" placeholder="Buy Now / View Offer">
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold small">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control-file" accept="image/*" required>
                            <small class="form-text text-muted">Recommended size: 600x300px</small>
                        </div>

                        <button type="submit" class="btn btn-info btn-block py-2 font-weight-bold text-white">
                            <i class="fa fa-plus mr-1"></i> Save Promo Banner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
