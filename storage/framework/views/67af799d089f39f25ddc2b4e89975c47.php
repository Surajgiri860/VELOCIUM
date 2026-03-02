<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Admin Wallet Address Settings</h4>
        </div>

        <div class="card-body">

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label>Admin Wallet Address</label>
                    <input type="text" 
                           name="admin_address" 
                           class="form-control" 
                           value="<?php echo e($config->admin_address ?? ''); ?>"
                           required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Update Address
                </button>

            </form>

        </div>
    </div>
</div>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/admin/settings.blade.php ENDPATH**/ ?>