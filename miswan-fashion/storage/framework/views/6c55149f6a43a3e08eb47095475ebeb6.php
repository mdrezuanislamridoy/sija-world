<?php $__env->startSection('content'); ?>
<div class="user-account-wrapper py-5 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>">Account</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></li>
            </ol>
        </nav>

        <div class="row">
            <!-- User Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-lg p-3 bg-white mb-3">
                    <div class="text-center p-3 border-bottom mb-3">
                        <div class="user-avatar-circle bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px; font-size: 22px;">
                            <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

                        </div>
                        <h6 class="font-weight-bold text-dark m-0"><?php echo e(Auth::user()->name); ?></h6>
                        <small class="text-muted"><?php echo e(Auth::user()->phone); ?></small>
                    </div>

                    <div class="nav flex-column nav-pills">
                        <a class="nav-link text-dark font-weight-bold mb-1 <?php echo e(request()->routeIs('user.dashboard') ? 'active bg-primary text-white' : ''); ?>" href="<?php echo e(route('user.dashboard')); ?>">
                            <i class="fa fa-tachometer mr-2"></i> Dashboard
                        </a>
                        <a class="nav-link text-dark font-weight-bold mb-1 <?php echo e(request()->routeIs('user.orders*') ? 'active bg-primary text-white' : ''); ?>" href="<?php echo e(route('user.orders')); ?>">
                            <i class="fa fa-shopping-bag mr-2"></i> My Orders
                        </a>
                        <a class="nav-link text-dark font-weight-bold mb-1 <?php echo e(request()->routeIs('user.profile') ? 'active bg-primary text-white' : ''); ?>" href="<?php echo e(route('user.profile')); ?>">
                            <i class="fa fa-user mr-2"></i> Profile Settings
                        </a>
                        <div class="dropdown-divider my-2"></div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link btn btn-link text-left text-danger font-weight-bold w-100 p-2">
                                <i class="fa fa-sign-out mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                <?php echo $__env->yieldContent('user_content'); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/user/layout.blade.php ENDPATH**/ ?>