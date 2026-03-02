@include('layouts.header')
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
                               @if($add_fund_requests->count() > 0)
                                  @foreach($add_fund_requests as $request)
                                     <tr>
                                        <td>
                                           {{ $request->user->name ?? 'N/A' }}<br>
                                           <small>Code: {{ $request->user->referal_code ?? 'N/A' }}</small>
                                        </td>
                                        <td>{{ $request->transaction_id ?? 'N/A' }}</td>
                                        <td>${{ number_format($request->amount, 2) }}</td>
                                        <td>{{ $request->created_at->format('d M Y h:i A') }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ $request->status_label }}
                                            </span>
                                        </td>
                                     </tr>
                                  @endforeach
                               @else
                                  <tr>
                                     <td colspan="5" class="text-center">No approved fund requests found</td>
                                  </tr>
                               @endif
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
@include('layouts.footer')