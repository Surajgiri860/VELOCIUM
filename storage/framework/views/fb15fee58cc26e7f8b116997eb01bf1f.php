<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="card ">
            <div class="card-header ">
               <h5 class="card-title" id="pagetitle">Fund Withdrawal History</h5>
            </div>
            <div class="card-body form_design">
               <div class="row">
                  <div class="col-md-12">
                     <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="dataTables_scroll">
                           <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid">
                              <thead>
                                 <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if($history->count()): ?>
                                     <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                                         <td><?php echo e($item->created_at); ?></td>
                                         <td><?php echo e($item->amount); ?></td>
                                         <td>
                                            <?php if($item->status == 0): ?>
                                                <span style="color: Yellow">Pending</span>
                                            <?php elseif($item->status == 2): ?>
                                                <span style="color: rgb(27, 232, 27)">Complete</span>
                                            <?php else: ?>
                                                <span style="color: rgb(247, 19, 19)">Reject</span>
                                            <?php endif; ?>
                                         </td>
                                     </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php else: ?>
                                     <tr>
                                         <td colspan="3" class="text-center">No data found</td>
                                     </tr>
                                 <?php endif; ?>
                              </tbody>
                           </table>
                        </div>
                        <!-- Centered Pagination Links -->
                        <div class="d-flex justify-content-center">
                           <?php echo e($history->links()); ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/transactions/WithdrawalHistory.blade.php ENDPATH**/ ?>