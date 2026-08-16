

<?php $__env->startSection('title', 'Manage Sliders & Banners'); ?>
<?php $__env->startSection('page_title', 'Sliders & Dynamic Purchasable Banners'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="row">
    <div class="col-12 mb-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <ul class="nav nav-pills mb-3 border-bottom pb-2" id="bannerTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" id="sliders-tab" data-toggle="tab" href="#sliders" role="tab" aria-controls="sliders" aria-selected="true">
                    <i class="fa fa-images mr-1"></i> Hero Carousel Sliders (<?php echo e($sliders->count()); ?>)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">
                    <i class="fa fa-ad mr-1"></i> Promotional Banners (<?php echo e($banners->count()); ?>)
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
                                <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo e(asset($slider->image)); ?>" width="110" height="50" class="rounded border" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <strong class="text-dark d-block"><?php echo e($slider->title); ?></strong>
                                            <?php if($slider->subtitle): ?>
                                                <small class="text-muted"><?php echo e($slider->subtitle); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($slider->product): ?>
                                                <span class="badge badge-success mb-1 d-inline-block"><i class="fa fa-shopping-cart mr-1"></i> <?php echo e($slider->product->name); ?></span>
                                                <small class="d-block text-primary font-weight-bold">TK <?php echo e(number_format($slider->product->price)); ?></small>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">No Product Linked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><code><?php echo e(Str::limit($slider->link, 30)); ?></code></td>
                                        <td><span class="badge badge-light border"><?php echo e($slider->sort_order); ?></span></td>
                                        <td class="text-right">
                                            <form method="POST" action="<?php echo e(route('admin.sliders.destroy', $slider->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this hero slider?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No Hero Sliders found. Add one using the form on the right!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Create Hero Slider Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Hero Slider</h5>

                    <form method="POST" action="<?php echo e(route('admin.sliders.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
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
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($prod->id); ?>"><?php echo e($prod->name); ?> (TK <?php echo e(number_format($prod->price)); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo e(asset($banner->image)); ?>" width="110" height="50" class="rounded border" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <?php if($banner->position === 'middle_banner'): ?>
                                                <span class="badge badge-info"><i class="fa fa-th-large mr-1"></i> Middle Section</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning"><i class="fa fa-star mr-1"></i> Side Hero Promo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong class="text-dark d-block"><?php echo e($banner->title); ?></strong>
                                            <?php if($banner->subtitle): ?>
                                                <small class="text-muted"><?php echo e($banner->subtitle); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($banner->product): ?>
                                                <span class="badge badge-success mb-1 d-inline-block"><i class="fa fa-shopping-cart mr-1"></i> <?php echo e($banner->product->name); ?></span>
                                                <small class="d-block text-primary font-weight-bold">TK <?php echo e(number_format($banner->product->price)); ?></small>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">No Product Linked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><code><?php echo e(Str::limit($banner->link, 30)); ?></code></td>
                                        <td class="text-right">
                                            <form method="POST" action="<?php echo e(route('admin.banners.destroy', $banner->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this promo banner?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No Promotional Banners found. Add one using the form on the right!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Create Banner Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                    <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Promo Banner</h5>

                    <form method="POST" action="<?php echo e(route('admin.banners.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
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
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($prod->id); ?>"><?php echo e($prod->name); ?> (TK <?php echo e(number_format($prod->price)); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>