<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5 id="pagetitle">Team List</h5>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                  <form id="levelForm" method="GET" action="<?php echo e(route('TeamList')); ?>">
                     <div class="form-group col-md-2">
                         <select id="dropLevelNoSrch" name="level" class="form-control custom-select" onchange="document.getElementById('levelForm').submit();" style="width: 100px;">
                             <?php for($i = 1; $i <= 20; $i++): ?>
                                 <option value="<?php echo e($i); ?>" <?php echo e($selectedLevel == $i ? 'selected' : ''); ?>>Level-<?php echo e($i); ?></option>
                             <?php endfor; ?>
                         </select>
                     </div>
                 </form>
                </div><br>

                <div class="row">
                  <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                          <div class="dataTables_scroll">
                              <div class="dataTables_scrollBody" style="overflow: auto; max-height: 500px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Package</th>
                                              <th>Status</th>
                                              <th>Date of Activation</th>
                                              <th>Level</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->referal_code); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->investmentHistories?->sum('amount') ?? 0); ?></td>

                                            <td style="<?php echo e($user->status == 0 ? 'color: rgb(247, 19, 19)' : 'color: rgb(27, 232, 27)'); ?>">
                                                <?php echo e($user->status == 0 ? 'InActive' : 'Active'); ?></td>
                                            <td><?php echo e($user->created_at); ?></td>
                                            <td>Level <?php echo e($user->level ?? 'N/A'); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="dataTables_info" id="tbldata_info" role="status" 
                                aria-live="polite">Showing <?php echo e($allUsers->firstItem()); ?>

                                 to <?php echo e($allUsers->lastItem()); ?> of <?php echo e($allUsers->total()); ?> 
                                 entries
                                </div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    <?php echo e($allUsers->links('pagination::bootstrap-4')); ?>

                                </div>
                      </div>
                  </div>
              </div>
             </div>
          </div>
       </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Network/TeamList.js?version=05112022"></script>
</div>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/network/TeamList.blade.php ENDPATH**/ ?>