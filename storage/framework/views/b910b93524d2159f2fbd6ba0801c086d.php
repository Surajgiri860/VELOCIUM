<?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="content">
    <div class="row">
        <div class="offset-md-2 col-md-6">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <div class="divPageTitle">
                        <h5>Activate/Upgrade My ID</h5>
                        <div class="btnRight"></div>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
                <div class="row"  style="display: none;">
                    <div class="col-md-12 col-xs-12">
                        <div class="validate-box">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <div class="card-body form_design" >
                    <form action="<?php echo e(route('invest')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Activation Wallet Balance: </label>
                                                <input value="<?php echo e($user->activation_balance); ?>" type="text" class="form-control" maxlength="50" readonly="readonly">
                                                </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Package: *</label>
                                                <select name="package_id" class="form-control" required>
                                                    <?php $__currentLoopData = $all_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($package->id); ?>">Package of $<?php echo e($package->amount); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-warning hvr-glow">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Network/ActivateMyID.js?version=4"></script>
</div>

<?php echo $__env->make('includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<script>
    document.getElementById('copyIcon').addEventListener('click', function() {
        // Select the address text
        const addressElement = document.getElementById('address');
        const addressText = addressElement.innerText;

        // Create a temporary textarea to copy the address text
        const textarea = document.createElement('textarea');
        textarea.value = addressText;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        // Optional: Alert or show a message to indicate the address has been copied
        alert('Address copied to clipboard!');
    });
</script>

<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/activation/ActivateMyID.blade.php ENDPATH**/ ?>