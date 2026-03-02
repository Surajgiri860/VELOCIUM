<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">

            <form method="POST" 
                  action="<?php echo e(route('admin.user.update', $user->id)); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" 
                        value="<?php echo e($user->name); ?>" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" 
                        value="<?php echo e($user->email); ?>" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" 
                        value="<?php echo e($user->phone); ?>" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Wallet Address</label>
                    <input type="text" name="wallet_address" 
                        value="<?php echo e($user->wallet_address); ?>" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="2" <?php echo e($user->status == 2 ? 'selected' : ''); ?>>
                            Active
                        </option>
                        <option value="0" <?php echo e($user->status == 0 ? 'selected' : ''); ?>>
                            Inactive
                        </option>
                    </select>
                </div>

               

                <br>
                <button class="btn btn-success">
                    Update User
                </button>

            </form>

        </div>
    </div>
</div>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/edit_user.blade.php ENDPATH**/ ?>