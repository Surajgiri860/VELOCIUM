<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-header">
                <h5 class="card-title">Pending Fund Requests</h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                      <?php endif; ?>
                      <?php if(session('error')): ?>
                        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                      <?php endif; ?>
                      
                      <div class="table-responsive">
                         <table class="table table-striped table-bordered">
                            <thead>
                               <tr>
                                  <th>User</th>
                                  <th>Transaction ID</th>
                                  <th>Amount</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                  <th>Action</th>
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
                                            <span class="badge bg-warning text-dark">
                                                <?php echo e($request->status_label); ?>

                                            </span>
                                        </td>
                                        <td>
                                           <form action="<?php echo e(route('add_fund.accept', $request->id)); ?>" method="POST">
                                                 
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                            </form>
                                            <form action="<?php echo e(route('add_fund.reject', $request->id)); ?>" method="POST">
                                                 
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        </td>
                                     </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php else: ?>
                                  <tr>
                                     <td colspan="6" class="text-center">No pending fund requests found</td>
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
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/add_fund/index.blade.php ENDPATH**/ ?>