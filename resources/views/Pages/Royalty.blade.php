@include('includes.header');
<div class="content">
    <div class="row">
       <div class="col-md-12 text-right"></div>
    </div>
    <div class="row">
       <div class="col-md-12">
          <div class="card ">
             <div class="card-header ">
                <h5 class="card-title" id="pagetitle"> Royalty Rewards </h5>
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
                                           <th style="width: 68.8333px;">ID</th>
                                           <th style="width: 184.573px;">Name</th>
                                           <th style="width: 234.469px;">Team Business</th>
                                           <th style="width: 170.9479px">Reward</th>
                                        </tr>
                                     </thead>
                                  </table>
                               </div>
                            </div>
                            <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                               <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid">
                                  <tbody>
                                    @foreach($Reward as $Reward)
                                    <tr role="row" class="odd">
                                       <td>{{$Reward->id}}</td> 
                                       <td>{{$Reward->name}}</td> 
                                       <td>{{$Reward->team_business}}</td> 
                                       <td>
                                           {{$Reward->reward}}
                                           @if($Reward->status == 1)
                                               <span style="color: green; font-size: 18px;">✔</span>
                                           @endif
                                       </td>  
                                    </tr>
                                    @endforeach
                                  </tbody>
                               </table>
                            </div>
                         </div>
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
    <script src="UserJs/Network/DirectTeam.js?version=17082022"></script>
</div>

@include('includes.footer');
