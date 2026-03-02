<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="content">
    
    <div class="row">
       <div class="col-md-12">
          <div class="card ">
             <div class="card-header ">
                <h5 class="card-title" id="pagetitle">Fund Deposit History</h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                         
                         
                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 977.333px; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 977.333px; margin-left: 0px;" role="grid">
                                     <thead>
                                        <tr role="row">
                                           <th class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" style="width: 193.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending">Name</th>
                                           <th class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" style="width: 193.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                                           
                                           <th  style="width: 99.8542px;" data-column-index="2" class="sorting_disabled"  aria-label="Amount">Amount</th>
                                           <th  class="sorting_disabled"  style="width: 181.604px;" aria-label="Status">Status</th>
                                           
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table  class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  
                                  <tbody>
                                    <?php if($Invest_req): ?>
                                    <?php $__currentLoopData = $Invest_req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Invest_req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <tr class="odd">
                                        <td  class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" style="width: 193.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending" ><?php echo e($Invest_req->user->referal_code); ?></td>
                                        <td  class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" style="width: 235.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending" ><?php echo e($Invest_req->created_at); ?></td>
                                        <td style="width: 237px" data-column-index="2" class="sorting_disabled"  aria-label="Amount"><?php echo e($Invest_req->amount); ?></td>
                                        <?php if($Invest_req->status == 3): ?>
                                        <td style="color : rgb(245, 17, 17)" class="sorting_disabled"   aria-label="Status">Reject</td> 
                                        <?php endif; ?>
                                        
                                        
                                       

                                     </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php else: ?>
                                     <tr class="odd">
                                       <td valign="top" colspan="4" class="dataTables_empty">No data found</td>
                                    </tr>
                                    <?php endif; ?>
                                   
                                  </tbody>
                               </table>
                            </div>
                         </div>
                         <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
                         <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                            <ul class="pagination">
                               <li class="paginate_button page-item previous disabled" id="tbldata_previous"><a href="#" aria-controls="tbldata" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                               <li class="paginate_button page-item next disabled" id="tbldata_next"><a href="#" aria-controls="tbldata" data-dt-idx="1" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                         </div>
                      </div>
                      <div id="divDataloader" style="text-align: center; display: none;">
                         <img src="images/smallLoader.gif">
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <hr>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <script src="UserJs/Transactions/DepositHistory.js?version=17082022"></script>
 </div>


<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/investment/reject.blade.php ENDPATH**/ ?>