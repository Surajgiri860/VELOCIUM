@include('includes.header')

<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-header">
                <h5 class="card-title" id="pagetitle">Fund Deposit History</h5>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                         <div class="dataTables_scroll">
                            <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                               <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 100%; padding-right: 0px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid">
                                     <thead>
                                        <tr role="row">
                                           <th class="sorting_asc DTCR_tableHeader" tabindex="0" aria-controls="tbldata" rowspan="1" colspan="1" style="cursor: pointer;" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                                           <th data-column-index="2" class="sorting_disabled" aria-label="Amount">Amount</th>
                                           <th data-column-index="3" class="sorting_disabled" aria-label="Status">Status</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                  <tbody>
                                    @if ($invest_detail->isNotEmpty())
                                    @foreach($invest_detail as $detail) 
                                    <tr class="odd">
                                        <td style="width: 302px;" class="sorting_asc DTCR_tableHeader" aria-controls="tbldata" rowspan="1" colspan="1">{{$detail->created_at}}</td>
                                        <td style="width: 350px;" class="sorting_disabled" rowspan="1" colspan="1">{{$detail->amount}}</td>
                                        <td class="sorting_disabled" rowspan="1" colspan="1">
                                            @if($detail->status == 1)
                                                <span style="color: Yellow;">Pending</span>
                                            @else
                                                <span style="color: rgb(27, 232, 27);">Approved</span>
                                            @endif
                                        </td>
                                     </tr>
                                     @endforeach
                                     @else
                                     <tr class="odd">
                                       <td valign="top" colspan="3" class="dataTables_empty">No data found</td>
                                    </tr>
                                    @endif
                                  </tbody>
                               </table>
                            </div>
                         </div>
                         <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing {{ $invest_detail->count() }} entries</div>
                         <div class="dataTables_paginate paging_simple_numbers text-center" id="tbldata_paginate">
                            <ul class="pagination justify-content-center">
                               <li class="paginate_button page-item previous disabled" id="tbldata_previous">
                                   <a href="#" aria-controls="tbldata" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                               </li>
                               <li class="paginate_button page-item next disabled" id="tbldata_next">
                                   <a href="#" aria-controls="tbldata" data-dt-idx="1" tabindex="0" class="page-link">Next</a>
                               </li>
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
