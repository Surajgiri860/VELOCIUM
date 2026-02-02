
@include('includes.header');
               <div class="content">
                  <input type="hidden" name="ctl00$ContentPlaceHolder1$HidOrgTypeDashboard" id="HidOrgTypeDashboard" />
                  <div class="modal-dialog modal-sm divpopup" id="divShareLink" style="width: 400px; display: none;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title">Share your link</h4>
                           <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="divpopup-inner">
                           <div class="row">
                              <div class="col-sm-12 col-xs-12">
                                 <table class="tblwipitem">
                                    <tr>
                                       <th class="colhead" id="divShareImg" style="text-align: center;"></th>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center;">
                                          <a id="urlcopy1" class="linkcopy" onclick="CopyURL('urlcopy1');" data-val="https://fts.in.net/Reg/RefID/FTS1014129">https://fts.in.net/Reg/RefID/FTS1014129&nbsp;<i class="fa fa-copy"></i></a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center;">Share on</td>
                                    </tr>
                                    <tr>
                                       <td class="colval" style="text-align: center; font-size: 20px;">
                                          <br/>
                                          <a target="_blank" href="whatsapp://send?text=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-whatsapp"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-facebook-square"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=https://fts.in.net//Reg/RefID/FTS1014129">
                                          <i class="fa fa-linkedin-square"></i>
                                          </a>&nbsp;
                                          <a target="_blank" href="https://twitter.com/intent/tweet?url=https://fts.in.net//Reg/RefID/FTS1014129&text=">
                                          <i class="fa fa-twitter-square"></i>
                                          </a>
                                          &nbsp;
                                          <a target="_blank" href="https://pinterest.com/pin/create/button/?url=https://fts.in.net//Reg/RefID/FTS1014129&media=&description=">
                                          <i class="fa fa-pinterest-square"></i>
                                          </a>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="divpopbutton" style="text-align: center;">
                           <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closediv();" />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
                        <div id="coinmarketcap-widget-marquee" coins="1,1027,825,4687" currency="USD" theme="light" transparent="true" show-symbol-logo="true"></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 text-right">
                        <a href="{{route('WithdrawalRequest')}}" class="btn btn-warning">Claim My Earning</a>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card card-chart">
                           <div class="card-header  ">
                              <div class="divPageTitle">
                                 <h5 style="padding-top: 0px;">My Wallet Details</h5>
                                 <div class="btnRight">
                                    <a  href="{{route('Activate.index')}}" class="btn btn-success hvr-sweep-to-right collapsed" style="margin-left: 10px;">
                                    <i class="fa fa-fw fa-circle-thin topicon"></i><span>Activate My ID</span>
                                    </a>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="card-body" style="min-height: 190px;">
                              <div class="row">
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="cashsales">
                                       <figure>{{ number_format($user_data->activation_balance, 2) }}</figure>
                                       <h2 style="text-transform: none;">Activation Balance</h2>
                                    </div>
                                 </div>
                                 <div class="col-6 col-md-6 taskrounbd">
                                    <div class="receipts">
                                       <figure id="lblEWallet">{{ number_format($user_data->withdrawable, 2) }}</figure>
                                       <h2 style="text-transform: none;">Withdrawable Balance</h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card ">
                           <div class="card-header ">
                              <h5 class="card-title">My Staking Status</h5>
                           </div>
                           <div class="card-body " style="height: 190px; overflow: auto">
                              <table class="tblJobOrderItem">
                                 <tr>
                                    <th class="tdjobid">USDT Stake</th>
                                    <th style="width: 80px; text-align: right;" id="lblStaking">{{ number_format($user_data->total_investment ,2)}}</th>
                                 </tr>
                                 <tr>
                                    <th class="tdjobid">Daily Earning</th>
                                    <th style="text-align: right;" id="lblDailyEarning">{{ number_format($total_daily_roi,2)}}</th>
                                 </tr>
                                 
                                 <tr>
                                    <th class="tdjobid">Received Earning <span id="lblEarningPer" class="text-warning" style="font-family: 'Segoe UI'"></span></th>
                                    <th style="text-align: right;" id="lblEarning">{{ number_format($witdrowal,2)}}</th>
                                 </tr>
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">Earning Limit <span id="lblBalanceEarningPer" class="text-success" style="font-family: 'Segoe UI'"></span></th>
                                    <th style="width: 100px; text-align: right;" id="lblBalanceEarning">{{ number_format($Balance_Earning,2)}}</th>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card card-chart card-profile">
                           <div class="card-header">
                              <h5 class="card-title">My Profile
                                 <input type="text" id="referralLink" value="{{$referralLink}}" class="form-control" style="display: none">
                                 <a title="Share" style="float: right; color: #ffffff" onclick="copyReferralLink()">
                                 <i class="fa fa-share"></i>&nbsp;Share
                                 </a>
                              </h5>
                           </div>
                           <div class="card-body" style="padding-top: 10px; min-height: 180px;">
                              <div class="profiledetail-left">
                                 <img src="assets/img/logo.png" />
                              </div>
                              <div class="profiledetail-right profiledetail">
                                 <h3 id="divMemberName"></h3>
                                 <div class="profile-memberid">ID: <span >{{$user_data->referal_code}}</span></div>
                                 <div class="profile-text profile-sponsorid">Referral: <span>{{$user_data->referal_by}}</span></div>
                                 <div class="profile-text profile-regdate">Date of Registration: <span >{{$user_data->created_at->format('Y-m-d')}}</span></div>
                                 <div class="profile-text profile-activedate">Name: <span >{{$user_data->name}}</span></div>
                                 <div class="profile-text profile-activedate">
                                    Active Status: @if ($user_data->status ==0 )
                                    <span >Inactive</span>
                                    @else
                                    <span >Active</span>
                                 @endif
                              </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 d-none">
                        <div class="card ">
                           <div class="card-header ">
                              <h5 class="card-title">Thailand Trip Reward Status</h5>
                           </div>
                           <div class="card-body " style="height: 165px; overflow: auto">
                              <table class="tblJobOrderItem">
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">My Direct Business</th>
                                    <th style="width: 100px; text-align: right;" id="tdThaiTripDBusiness">0.00</th>
                                 </tr>
                                 <tr>
                                    <td colspan="2" class="tdWIPDtl"><span class="wipqty">Required Business: <i>$4200.00</i></span></td>
                                 </tr>
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">My Team Business</th>
                                    <th style="width: 100px; text-align: right;" id="tdThaiTripTBusiness">0.00</th>
                                 </tr>
                                 <tr>
                                    <td colspan="2" class="tdWIPDtl"><span class="wipqty">Required Business: <i>$12000.00</i></span></td>
                                 </tr>
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">Achievement Status</th>
                                    <th style="width: 100px; text-align: right;" id="tdThaiTripStatus">Pending</th>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card ">
                           <div class="card-header ">
                              <h5 class="card-title">My Earning</h5>
                           </div>
                           <div class="card-body " style="height: auto; overflow: auto">
                              <table id="tblMyEarning" class="tblJobOrderItem">
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">Staking Income</th>
                                    <th style="width: 100px; text-align: right;" id="tdROIIncome">{{number_format($user_data->staking_balance,2)}}</th>
                                 </tr>
                                 
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid"> Level Reward</th>
                                    <th style="width: 100px; text-align: right;" id="tdSonsorLevelIncome">{{number_format($user_data->level_balance,2)}}</th>
                                 </tr>
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">Direct Income</th>
                                    <th style="width: 100px; text-align: right;">{{number_format($user_data->direct_balance,2)}}</th>
                                 </tr>
                                 <tr>
                                    <th style="width: 80px;" class="tdjobid">Royalty Rewards</th>
                                    <th style="width: 100px; text-align: right;" id="tdROILevelIncome">{{number_format($user_data->royalty_balance,2)}}</th>
                                 </tr>
                                 <tr>
                                    <td colspan="2" class="tdWIPDtl"><span class="wipqty">Pending Amount: <i id="tdPROILevelIncome">{{$pending_reward}}</i></span></td>
                                 </tr>
                              </br>
                             
                              @if ($user_reward->count() > 0)
                              
                                  <tr>
                                    <td colspan="2" class="tdWIPDtl">
                                       @foreach ($user_reward as $reward)
                                       <span class="wipqty"> 
                                          <form action="{{ route('claim.reward', $reward->id) }}" method="POST">
                                              @csrf
                                              <button type="submit" class="btn btn-warning">
                                                  Claim Rewards
                                              </button>
                                          </form>
                                      </span>
                                          @endforeach
                                      </td>
                                     </tr>
                             
                          @else
                              <tr>
                                  <td colspan="2" class="tdWIPDtl">No rewards available</td>
                              </tr>
                          @endif
                          
                                 </div>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card ">
                                 <div class="card-header ">
                                    <h5 class="card-title">My Business Detail</h5>
                                 </div>
                                 <div class="card-body " style="height: 180px; overflow: auto">
                                    <table class="tblJobOrderItem tblBusinessDetail">
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-shopping-cart"></i>&nbsp;My Package</td>
                                          @if ($InvestmentHistoryCount > 0)
                                          <td style="width: 100px; text-align: right;" >{{$InvestmentHistoryCount}}</td>
                                          @else
                                          <td style="width: 100px; text-align: right;" >N/A</td>
                                          @endif
                                          
                                       </tr>
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-users"></i>&nbsp;Active Directs</td>
                                          <td style="width: 100px; text-align: right;" id="tdTotalDirectPV">{{$Active_Directs}}</td>
                                       </tr>
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-angellist"></i>&nbsp;Total Active Team</td>
                                          <td style="width: 100px; text-align: right;" id="tdTotalTeamPV">{{$indirectUsersCount}}</td>
                                       </tr>
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-angellist"></i>&nbsp;Power Leg Team</td>
                                          <td style="width: 100px; text-align: right;" id="tdTotalTeamPV">{{$power_leg_business}}</td>
                                       </tr>
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-angellist"></i>&nbsp;Other Leg Team</td>
                                          <td style="width: 100px; text-align: right;" id="tdTotalTeamPV">{{$other_team_business}}</td>
                                       </tr>
                                       <tr>
                                          <td style="width: 80px;" class="tdjobid"><i class="fa fa-angellist"></i>&nbsp;Total Team Business</td>
                                          <td style="width: 100px; text-align: right;" id="tdTotalTeamBusiness">{{$total_business}}</td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-10">
                               <div class="card" style="margin-top: 10px;">
                                   <div class="card-header">
                                       <h5 class="card-title">My Investment History</h5>
                                   </div>
                                   <div class="card-body" style="height: auto;">
                                       <table id="tblMyPurchase" class="tblwipitem table table-striped" style="border: none;">
                                           <thead>
                                               <tr>
                                                   <th>Amount</th>
                                                   <th>Date</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @foreach($user_investments   as $investment)
                                               <tr>
                                                   <td>{{ number_format($investment->amount, 2) }}</td> <!-- Format the amount -->
                                                   <td>{{ $investment->created_at->format('Y-m-d') }}</td> <!-- Format the date -->
                                               </tr>
                                               @endforeach
                                           </tbody>
                                       </table>
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
              @include('includes.footer');

              <script>
               function copyReferralLink() {
                   // Get the input field
                   var referralInput = document.getElementById("referralLink");
                   
                   // Make the input field visible for selection (optional)
                   referralInput.style.display = "block"; // Show for a moment
                   referralInput.select();
                   referralInput.setSelectionRange(0, 99999); // For mobile devices
               
                   // Copy the text inside the input field
                   document.execCommand("copy");
                   
                   // Hide the input field again
                   referralInput.style.display = "none"; // Hide again
               
                   // Optionally, show a message that the link was copied
                   alert("Referral link copied: " + referralInput.value);
               }
               </script>
               
               