<?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="content">
    <div class="row">
        <div class="offset-md-2 col-md-6">
            <div class="card smallPageHeader">
                
                <div class="card-header text-center">
                   <h5>Add Fund</h5>
                <p class="text-danger fw-bold">
                    ⚠ Please make payment only via BSC (Binance Smart Chain) Network.
                </p>
                <p class="text-muted">
                    Send funds only through BSC Scan (BEP-20). Payments made on any other network 
                    (ERC20 / TRC20 / Polygon etc.) will not be credited and may result in permanent loss of funds.
                </p>
                </div>

                <div class="card-body form_design">

                    
                    <?php if(!empty($config->admin_address)): ?>

                    <div class="card mb-4" style="border:1px solid #ddd;">
                        <div class="card-body text-center">

                            <h5 style="margin-bottom:15px;">Scan QR Code</h5>

                            <div style="margin-bottom:15px;">
                                <?php echo QrCode::size(200)->generate($config->admin_address); ?>

                            </div>

                            <div style="font-weight:bold; font-size:16px; word-break: break-all;">
                                <?php echo e($config->admin_address); ?>

                            </div>

                            <button onclick="copyAddress()" 
                                    class="btn btn-success mt-3"
                                    id="copyBtn">
                                Copy Address
                            </button>

                            <p id="copyMsg" 
                               style="color:green; display:none; margin-top:10px;">
                                Address Copied Successfully ✅
                            </p>

                        </div>
                    </div>

                    <?php endif; ?>


                    
                    <form action="<?php echo e(route('add.fund.request')); ?>" method="POST" id="addFundForm">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label>Amount (USDT): *</label>
                            <input name="amount" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Transaction ID: *</label>
                            <input name="transaction_id" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Remarks:</label>
                            <input name="remarks" type="text" class="form-control">
                        </div>

                        <div class="text-right">
                            <input type="submit" 
                                   class="btn btn-warning mt-3" 
                                   value="Submit">
                        </div>

                    </form>

                </div>
            </div>
        </div>

        
    </div>
</div>

<?php if(isset($requests) && $requests->count() > 0): ?>

<div class="card mt-4">
    <div class="card-header text-center">
        <h6>Your Fund Requests</h6>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered text-center mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td>$<?php echo e($req->amount); ?></td>
                    <td><?php echo e($req->transaction_id); ?></td>
                    <td>
                        <?php if($req->status == 1): ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php elseif($req->status == 2): ?>
                            <span class="badge badge-success">Approved</span>
                        <?php elseif($req->status == 3): ?>
                            <span class="badge badge-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php endif; ?>

<?php echo $__env->make('includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
function copyAddress() {
    var address = "<?php echo e($config->admin_address); ?>";

    navigator.clipboard.writeText(address).then(function() {

        var msg = document.getElementById("copyMsg");
        var btn = document.getElementById("copyBtn");

        msg.style.display = "block";
        btn.innerText = "Copied ✅";

        setTimeout(function() {
            msg.style.display = "none";
            btn.innerText = "Copy Address";
        }, 2000);

    }).catch(function() {
        alert("Failed to copy address ❌");
    });
}
</script><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/transactions/AddFund.blade.php ENDPATH**/ ?>