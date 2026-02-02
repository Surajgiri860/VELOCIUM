@include('includes.header');

<div class="content">
    <div class="row">
       <div class="col-md-12 text-right">
          <a id="btnAddNew" href="AddFund.aspx" class="btn btn-danger hvr-sweep-to-right">
          <i class="fa fa-fw fa-plus topicon"></i>Add New Request
          </a>
       </div>
    </div>
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
                         <div id="tbldata_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tbldata"></label></div>
                         <div class="dataTables_length" id="tbldata_length">
                            <label>
                               Show 
                               <select name="tbldata_length" aria-controls="tbldata" class="custom-select custom-select-sm form-control form-control-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                               </select>
                               entries
                            </label>
                         </div>
                         <div class="dt-buttons">   <a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>PDF</span></a> <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>Excel</span></a> <a class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="tbldata" href="#"><span>CSV</span></a> </div>
                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 977.333px; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 977.333px; margin-left: 0px;" role="grid">
                                     <thead>
                                        <tr role="row">
                                           <th data-column-index="0" class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 193.531px; cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                                           <th data-column-index="1" class="sorting" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 437.01px;" aria-label="Transaction ID: activate to sort column ascending">Transaction ID</th>
                                           <th style="width: 99.8542px;" data-column-index="2" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">Amount</th>
                                           <th data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px;" aria-label="Status">Status</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  <thead>
                                     <tr role="row" style="height: 0px;">
                                        <th data-column-index="0" class="sorting_asc DTCR_tableHeader" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 193.531px; cursor: pointer; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="Date: activate to sort column descending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Date</div>
                                        </th>
                                        <th data-column-index="1" class="sorting" aria-controls="tbldata" rowspan="1" colspan="1" style="width: 437.01px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Transaction ID: activate to sort column ascending">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Transaction ID</div>
                                        </th>
                                        <th style="width: 99.8542px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" data-column-index="2" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Amount">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Amount</div>
                                        </th>
                                        <th data-column-index="3" class="sorting_disabled" rowspan="1" colspan="1" style="width: 181.604px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Status">
                                           <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Status</div>
                                        </th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr class="odd">
                                        <td valign="top" colspan="4" class="dataTables_empty">No data found</td>
                                     </tr>
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

@include('includes.footer');