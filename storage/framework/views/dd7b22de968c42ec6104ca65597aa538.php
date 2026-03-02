<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-header">
                <h5 class="card-title">Approved Fund Requests</h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <div class="table-responsive">
                         <table class="table table-striped table-bordered">
                            <thead>
                               <tr>
                                  <th>User</th>
                                  <th>Transaction ID</th>
                                  <th>Amount</th>
                                  <th>Date</th>
                                  <th>Status</th>
                               </tr>
                            </thead>
                            <tbody>
                               <?php if($add_fund_requests->count() > 0): ?>
                                  <?php $__currentLoopData = $add_fund_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                                        <td>
                                           <?php echo e($request->user->name ?? 'N/A'); ?><br>
                                           <small>Code: <?php echo e($request->user->referal_code ?? 'N/A'); ?></small>
                                        </td>
                                        <td><?php echo e($request->transaction_id ?? 'N/A'); ?></td>
                                        <td>$<?php echo e(number_format($request->amount, 2)); ?></td>
                                        <td><?php echo e($request->created_at->format('d M Y h:i A')); ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?php echo e($request->status_label); ?>

                                            </span>
                                        </td>
                                     </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php else: ?>
                                  <tr>
                                     <td colspan="5" class="text-center">No approved fund requests found</td>
                                  </tr>
                               <?php endif; ?>
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/add_fund/approved.blade.php ENDPATH**/ ?>