<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

<div class="content">
    <div class="row">
        <div class="col-md-12 text-right"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="pagetitle">My Direct Team</h5>
                </div>
                <div class="card-body form_design">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $DirectTeam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($user->referal_code); ?></td>
                                                    <td><?php echo e($user->name); ?></td>
                                                    <?php if($user->investmentHistory->isNotEmpty()): ?>
                                                        <?php
                                                        $totalAmount = $user->investmentHistory->sum('amount');
                                                        ?>
                                                        <td><?php echo e($totalAmount); ?></td>
                                                        <td style="<?php echo e($user->status == 0 ? 'color: rgb(247, 19, 19)' : 'color: rgb(27, 232, 27)'); ?>">
                                                            <?php echo e($user->status == 0 ? 'InActive' : 'Active'); ?></td>
                                                        <td><?php echo e($user->created_at); ?></td>
                                                    <?php else: ?>
                                                        <td>0</td>
                                                        <td style="color: rgb(247, 19, 19)">Inactive</td>
                                                        <td>----</td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_info" id="tbldata_info" role="status" 
                                aria-live="polite">Showing <?php echo e($DirectTeam->firstItem()); ?>

                                 to <?php echo e($DirectTeam->lastItem()); ?> of <?php echo e($DirectTeam->total()); ?> 
                                 entries
                                </div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    <?php echo e($DirectTeam->links('pagination::bootstrap-4')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divDataloader" style="text-align: center; display: none;">
                        <img src="images/smallLoader.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="UserJs/Network/DirectTeam.js?version=17082022"></script>
</div>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/network/DirectTeam.blade.php ENDPATH**/ ?>