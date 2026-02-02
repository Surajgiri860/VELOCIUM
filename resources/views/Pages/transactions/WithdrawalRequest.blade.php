@include('includes.header');

<div class="content">
    <div class="row">
       <div class="offset-md-3 col-md-6">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Claim My Earnings</h5>
                   <div class="btnRight">
                      <a id="btnView" href="{{route('WithdrawalHistory')}}" class="btn btn-danger hvr-sweep-to-right collapsed">
                      <i class="fa fa-fw fa-circle-thin topicon"></i>View History
                      </a>
                   </div>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="row" id="divValidateSummary" style="display: none;">
                <div class="col-md-12 col-xs-12">
                   <div class="validate-box">
                      <ul></ul>
                   </div>
                </div>
             </div>
             <form action="{{ route('withdraw') }}" method="POST">
               @csrf
             <div class="card-body form_design" id="divAddForm">
                <div class="row">
                   <div class="form-group col-md-12">
                      <div class="row">
                       
                         <div class="form-group col-md-12">
                            <div class="clearfix"></div>
                            <div class="row">
                               <div class="form-group col-md-6">
                                  <label>Wallet Balance: </label>
                                  <input value="{{$user_details->withdrawable}}" type="text" class="form-control" maxlength="50" readonly="readonly">
                               </div>
                            </div>
                            <div class="row">
                               <div class="form-group col-md-6">
                                  <label>USDT (Min $20): *</label>
                                  <input name="usdt_amount" type="number" class="form-control" maxlength="50">
                               </div>
                            </div>
                            
                         </div>
                        
                      </div>
                   </div>
                </div>
                {{-- <div class="row">
                  <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-warning hvr-glow">Withdraw</button>
                  </div>
              </div> --}}
                <div class="row">
                   <div class="col-md-12 text-right">
                      <input type="submit" class="btn btn-warning hvr-glow" value="Withdraw" id="btnsave">
                   </div>
                </div>
             </div>
            </form>
          </div>
       </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Transactions/WithdrawalRequest.js?version=10022024"></script>
 </div>

@include('includes.footer');