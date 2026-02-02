{{-- include header --}}
@include('layouts.header');
               <div class="content">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card card-chart">
                          
                           <div class="card-body" style="min-height: 190px;">
                              <div class="row">
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="cashsales">
                                       <figure>{{ number_format($monthlyInvestmentSum, 2) }}</figure>
                                       <h2 style="text-transform: none;">Investment Balance</h2>
                                    </div>
                                 </div>
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="receipts">
                                       <figure id="lblEWallet">{{number_format($monthlyPayOutSum,2)}}</figure>
                                       <h2 style="text-transform: none;">PayOut Balance</h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card card-chart">
                          
                           <div class="card-body" style="min-height: 190px;">
                              <div class="row">
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="cashsales">
                                       <figure style="border-color: #00f27c;">{{ number_format($totalInvestmentSum) }}</figure>
                                       <h2 style="text-transform: none;">Total Balance</h2>
                                    </div>
                                 </div>
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="receipts">
                                       <figure id="lblEWallet" style="border-color: #00f27c;">{{number_format($totalpayout,2)}}</figure>
                                       <h2 style="text-transform: none;">Total PayOut Balance</h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                    
                     <div class="col-md-4">
                        <div class="card ">
                           <div class="card-header ">
                              <h5 class="card-title">My Business Detail</h5>
                           </div>
                           <div class="card-body " style="height: 120px; overflow: auto">
                              <table class="tblJobOrderItem tblBusinessDetail">
                                 <tbody><tr>
                                    <td style="width: 80px;" class="tdjobid"><i class="fa fa-users"></i>&nbsp;Active User</td>
                                                                              <td style="width: 100px; text-align: right;">{{$activeUserCount}}</td>
                                                                              
                                 </tr>
                                 <tr>
                                    <td style="width: 80px;" class="tdjobid"><i class="fa fa-users"></i>&nbsp;InActive User</td>
                                    <td style="width: 100px; text-align: right;" id="tdTotalDirectPV">{{$inactiveUserCount}}</td>
                                 </tr>
                                 <tr>
                                    <td style="width: 80px;" class="tdjobid"><i class="fa fa-users"></i>&nbsp;Total Active User</td>
                                    <td style="width: 100px; text-align: right;" id="tdTotalTeamPV">{{$totalUserCount}}</td>
                                 </tr>
                                 
                              </tbody></table>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card card-chart">
                          
                           <div class="card-body" style="min-height: 190px;">
                              <div class="row">
                                 <div class="col-12 col-md-12 taskrounbd">
                                    <div class="cashsales">
                                       <figure>{{ number_format($totalwithdralSum, 2) }}</figure>
                                       <form action="{{ route('admin.payoutList') }}" method="GET" style="display: inline;">
                                          @csrf
                                          <button type="submit" class="btn btn-warning">Payout Closing</button>
                                      </form>
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               
                  <script src="assets/js/plugins/chartjs.min.js"></script>
                  <script src="UserJs/Dashboard/Dashboard.js?version=2"></script>
               </div>
              {{-- include footer --}}
              @include('layouts.footer');