<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Portal Login - SijaWorld</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/font-awesome.css')); ?>" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card border-0 shadow-lg rounded-lg p-4 bg-white">
                    <div class="text-center mb-4">
                        <img src="https://www.sijaworld.com/core/public/storage/images/l4WGlogo.png" alt="SijaWorld Logo" class="mb-3" style="max-height: 50px;">
                        <h4 class="font-weight-bold text-dark mb-1">Admin Portal</h4>
                        <p class="text-muted small">SijaWorld Management</p>
                    </div>

                    <?php if(isset($errors) && $errors->any()): ?>
                        <div class="alert alert-danger p-2 small">
                            <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('admin.login.post')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark small">Admin Email</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@sijaworld.com" value="<?php echo e(old('email')); ?>" required autofocus>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark small">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-sign-in mr-1"></i> Sign In to Admin Panel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Volumes/2BT/Ridoy/fashion.picci/sija-world/miswan-fashion/resources/views/admin/login.blade.php ENDPATH**/ ?>