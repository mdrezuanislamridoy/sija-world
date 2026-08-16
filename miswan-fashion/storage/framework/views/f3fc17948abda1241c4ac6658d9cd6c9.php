

<?php $__env->startSection('title', 'Admin Staff & Page Permissions'); ?>
<?php $__env->startSection('page_title', 'Admin Staff & Page Permissions'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="row">
    <div class="col-12 mb-3">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle mr-2"></i> <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Admin Users List -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h5 class="font-weight-bold text-dark m-0"><i class="fa fa-users-cog text-primary mr-2"></i> Dashboard Admin Users</h5>
                <span class="badge badge-primary px-3 py-2">Total Accounts: <?php echo e($admins->count()); ?></span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>User Info</th>
                            <th>Role</th>
                            <th>Allowed Page Permissions</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adminUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong class="text-dark d-block" style="font-size: 15px;"><?php echo e($adminUser->name); ?></strong>
                                    <small class="text-muted d-block"><i class="fa fa-envelope mr-1"></i> <?php echo e($adminUser->email); ?></small>
                                    <?php if($adminUser->phone): ?>
                                        <small class="text-muted d-block"><i class="fa fa-phone mr-1"></i> <?php echo e($adminUser->phone); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($adminUser->isSuperAdmin()): ?>
                                        <span class="badge badge-primary px-2 py-1"><i class="fa fa-crown mr-1"></i> Superadmin</span>
                                    <?php else: ?>
                                        <span class="badge badge-info px-2 py-1"><i class="fa fa-user-shield mr-1"></i> Sub-Admin / Staff</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($adminUser->isSuperAdmin()): ?>
                                        <span class="badge badge-success px-2 py-1"><i class="fa fa-infinity mr-1"></i> All Pages Granted (Full Access)</span>
                                    <?php else: ?>
                                        <?php $perms = $adminUser->permissions ?? []; ?>
                                        <?php if(count($perms) > 0): ?>
                                            <div class="d-flex flex-wrap gap-1" style="max-width: 280px;">
                                                <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pKey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($allPermissions[$pKey])): ?>
                                                        <span class="badge badge-light border text-dark font-weight-normal mb-1 mr-1">
                                                            <i class="fa fa-check text-success mr-1"></i> <?php echo e(str_replace('Manage ', '', strtok($allPermissions[$pKey], ' ('))); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="badge badge-warning text-dark">No Page Permissions Assigned</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($adminUser->status): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#editAdminModal<?php echo e($adminUser->id); ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <?php if(Auth::guard('admin')->id() != $adminUser->id): ?>
                                        <form method="POST" action="<?php echo e(route('admin.users.destroy', $adminUser->id)); ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this admin user?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Edit Admin Modal -->
                            <div class="modal fade" id="editAdminModal<?php echo e($adminUser->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel<?php echo e($adminUser->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title font-weight-bold"><i class="fa fa-user-edit mr-2"></i> Edit Admin Staff: <?php echo e($adminUser->name); ?></h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="<?php echo e(route('admin.users.update', $adminUser->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-body p-4 text-left">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" class="form-control" value="<?php echo e($adminUser->name); ?>" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">Email Address <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" class="form-control" value="<?php echo e($adminUser->email); ?>" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">Phone Number</label>
                                                        <input type="text" name="phone" class="form-control" value="<?php echo e($adminUser->phone); ?>">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">New Password (Leave blank to keep unchanged)</label>
                                                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">Account Role <span class="text-danger">*</span></label>
                                                        <select name="role" class="form-control role-select-edit" data-target="permissionsEditArea<?php echo e($adminUser->id); ?>" required>
                                                            <option value="super_admin" <?php echo e($adminUser->role === 'super_admin' ? 'selected' : ''); ?>>Superadmin (Full Access to All Pages)</option>
                                                            <option value="sub_admin" <?php echo e($adminUser->role === 'sub_admin' ? 'selected' : ''); ?>>Sub-Admin / Staff (Restricted Page Permissions)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="font-weight-bold">Account Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1" <?php echo e($adminUser->status == 1 ? 'selected' : ''); ?>>Active</option>
                                                            <option value="0" <?php echo e($adminUser->status == 0 ? 'selected' : ''); ?>>Disabled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div id="permissionsEditArea<?php echo e($adminUser->id); ?>" class="form-group mb-0">
                                                    <label class="font-weight-bold text-dark mb-2">Allowed Dashboard Page Permissions:</label>
                                                    <p class="small text-muted mb-3">Check which pages this sub-admin is authorized to view and manage.</p>

                                                    <div class="row">
                                                        <?php $userPerms = $adminUser->permissions ?? []; ?>
                                                        <?php $__currentLoopData = $allPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permKey => $permLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6 mb-2">
                                                                <div class="custom-control custom-checkbox p-2 border rounded bg-light">
                                                                    <input type="checkbox" name="permissions[]" value="<?php echo e($permKey); ?>" class="custom-control-input" id="edit_perm_<?php echo e($adminUser->id); ?>_<?php echo e($permKey); ?>" <?php echo e(in_array($permKey, $userPerms) ? 'checked' : ''); ?>>
                                                                    <label class="custom-control-label font-weight-bold text-dark small" for="edit_perm_<?php echo e($adminUser->id); ?>_<?php echo e($permKey); ?>">
                                                                        <?php echo e($permLabel); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold"><i class="fa fa-save mr-1"></i> Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create New Admin Form -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">
                <i class="fa fa-user-plus text-primary mr-1"></i> Create Admin Staff
            </h5>

            <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Tanvir Ahmed" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Email Address <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="manager@miswanfashion.com" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="01712345678">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Login Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Account Role <span class="text-danger">*</span></label>
                    <select name="role" id="createAdminRole" class="form-control" required>
                        <option value="sub_admin" selected>Sub-Admin / Staff (Custom Permissions)</option>
                        <option value="super_admin">Superadmin (Full Unrestricted Access)</option>
                    </select>
                </div>

                <div id="createPermissionsArea" class="form-group mb-4 p-3 border rounded bg-light">
                    <label class="font-weight-bold text-dark small mb-2 d-block border-bottom pb-1">
                        Select Allowed Page Permissions:
                    </label>

                    <?php $__currentLoopData = $allPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permKey => $permLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" name="permissions[]" value="<?php echo e($permKey); ?>" class="custom-control-input" id="create_perm_<?php echo e($permKey); ?>" checked>
                            <label class="custom-control-label small font-weight-bold text-dark" for="create_perm_<?php echo e($permKey); ?>">
                                <?php echo e($permLabel); ?>

                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
                    <i class="fa fa-plus-circle mr-1"></i> Add Admin User
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/users/index.blade.php ENDPATH**/ ?>