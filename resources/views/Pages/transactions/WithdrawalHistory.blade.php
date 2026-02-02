@include('includes.header')

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
                                 @if ($history->count())
                                     @foreach($history as $item)
                                     <tr>
                                         <td>{{ $item->created_at }}</td>
                                         <td>{{ $item->amount }}</td>
                                         <td>
                                            @if($item->status == 0)
                                                <span style="color: Yellow">Pending</span>
                                            @elseif($item->status == 2)
                                                <span style="color: rgb(27, 232, 27)">Complete</span>
                                            @else
                                                <span style="color: rgb(247, 19, 19)">Reject</span>
                                            @endif
                                         </td>
                                     </tr>
                                     @endforeach
                                 @else
                                     <tr>
                                         <td colspan="3" class="text-center">No data found</td>
                                     </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                        <!-- Centered Pagination Links -->
                        <div class="d-flex justify-content-center">
                           {{ $history->links() }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('includes.footer')
