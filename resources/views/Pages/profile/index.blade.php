{{-- include header --}}
@include('includes.header');
<div class="content">
   <div class="modal-dialog modal-sm divpopup" id="divValidateOTP" style="width: 400px; display: none;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Verify with OTP</h4>
            <button type="button" class="close" onclick="closediv();"><span aria-hidden="true">×</span></button>
         </div>
         <div class="divpopup-inner">
            <div class="row">
               <div class="col-sm-12 col-xs-12">
                  <div class="ctrl">
                     <label class="col-sm-12 lbl text-info">Enter OTP received on your registered email : </label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="txtKYCOTP">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="divpopbutton" style="text-align: center;">
            <input type="button" class="subbtn" value="Validate" id="btnValidate">
            <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closediv();">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="offset-md-1 col-md-10">
         <div class="card smallPageHeader">
            <div class="card-header">
               <div class="divPageTitle">
                  <h5>Update Profile</h5>
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
            <div class="card-body form_design" id="divAddForm">
               <div class="row">
                  <div class="form-group col-md-12">
                     <div class="row">
                        <div class="col-md-12">
                           <h5 class="title">Personal Detail</h5>
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="row">
                                    <div class="form-group  col-sm-12 col-xs-12" title="Upload Member Photo" id="divImage">
                                       <div id="btnfileselect" class="UploadPhoto" style="background-image: url(assets/img/NoImage.jpg);">
                                          <div id="btnFileSelectInner"></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="col-md-9">
                                <form method="POST" action="{{ route('profile.update', $user_detail->id) }}">
                                    @csrf
                                    @method('PUT')
                                 <div class="row">
                                    <div class="form-group  col-4">
                                       <label>Prefix: *</label>
                                       <select name="prefix" class="form-control">
                                        <option value="Mr." {{ $user_detail->prefix == 'Mr.' ? 'selected' : '' }}>Mr</option>
                                        <option value="Ms." {{ $user_detail->prefix == 'Ms.' ? 'selected' : '' }}>Ms</option>
                                        <option value="Mis." {{ $user_detail->prefix == 'Mis.' ? 'selected' : '' }}>Mis</option>
                                        <option value="Dr." {{ $user_detail->prefix == 'Dr.' ? 'selected' : '' }}>Dr</option>
                                        <option value="Prof." {{ $user_detail->prefix == 'Prof.' ? 'selected' : '' }}>Prof</option>
                                    </select>
                                    </div>
                                    <div class="form-group  col-8">
                                       <label>Name: *</label>
                                       <input type="text" name="name" value="{{$user_detail->name}}" class="form-control " maxlength="50" readonly="readonly" disabled="">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label>Email: *</label>
                                       <input type="email" name="email" value="{{$user_detail->email}}" class="form-control" maxlength="50">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Mobile No.: *</label>
                                       <input type="text" name="phone" value="{{$user_detail->phone}}" class="form-control" maxlength="10">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label>Gender: *</label>
                                       <select name="gender" class="form-control">
                                        <option value="Male" {{ $user_detail->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user_detail->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $user_detail->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12 text-right">
                                      <button type="submit" class="btn btn-warning hvr-glow">Update</button>
                                       {{-- <input type="Submit" class="btn btn-warning hvr-glow" value="Submit"> --}}
                                    </div>
                                 </div>
                                </form>
                              </div>
                            
                           </div>
                        </div>
                     </div>
                    
                  </div>
               </div>
              
            </div>
         </div>
      </div>
   </div>
   <iframe src="Upload.aspx" id="ifuploadfile" style="display: none;"></iframe>
   <script src="MasterJs/Attachment.js"></script>
   <script src="MasterJs/AddressJs.js"></script>
   <script src="UserJs/Network/UpdateProfile.js?version=10022024"></script>
</div>
{{-- include footer --}}
@include('includes.footer');