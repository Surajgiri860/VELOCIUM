@include('includes.header');
<style>
   .popup {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1000; /* Sit on top */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.popup-content {
   background-color: #fefefe;
   margin: 15% auto; /* 15% from the top and centered */
   padding: 20px;
   border: 1px solid #888;
   width: 40%; /* Could be more or less, depending on screen size */
}

.close {
   color: #aaa;
   float: right;
   font-size: 28px;
   font-weight: bold;
}

.close:hover,
.close:focus {
   color: black;
   text-decoration: none;
   cursor: pointer;
}
@media (max-width: 768px) {
   .popup-content {
   
   width: 80%; /* Could be more or less, depending on screen size */
}
}

/* Styles for tablets (min-width: 769px and max-width: 1024px) */
@media (min-width: 769px) and (max-width: 1024px) {
   .popup-content {
   
   width: 80%; /* Could be more or less, depending on screen size */
}
}



</style>
<div class="content">
    <div class="row">
       <div class="offset-md-2 col-md-6">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>Add Fund</h5>
                   <div class="btnRight">
                     <span class="btn btn-warning hvr-glow" onclick="openQRCodePopup()"> Scan QR Code </span>
                     
                      </a>
                   </div>
                   <div id="qrCodePopup" class="popup">
                     <div class="popup-content">
                         <span class="close" onclick="closeQRCodePopup()">&times;</span>
                         <h2>Scan QR Code</h2>
                         <img src="assets/img/QRCODE.jpg" alt="QR Code" />
                     </div>
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
             <form action="{{ route('add.fund.request') }}" method="POST" id="addFundForm">
               @csrf
               <div class="card-body form_design" id="divAddForm">
                   <div class="row">
                       <div class="form-group col-md-12">
                           <div class="row">
                               <div class="form-group col-md-12">
                                   <div class="clearfix"></div>
                                   <div class="row">
                                       <div class="form-group col-md-6">
                                           <label>Amount (USDT): *</label>
                                           <input id="txtAmount" name="amount" type="text" class="form-control" maxlength="50" required>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="form-group col-md-12">
                                           <label>Transaction ID: *</label>
                                           <input id="txtTranID" name="transaction_id" type="text" class="form-control" maxlength="200" required>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="form-group col-md-12">
                                           <label>Remarks: </label>
                                           <input id="txtRemarks" name="remarks" type="text" class="form-control" maxlength="200">
                                       </div>
                                   </div>
                                   <div class="row" style="display:none;">
                                       <div class="form-group col-md-12">
                                           <label>Upload Screenshot: * </label>
                                           <div>
                                               <input type="button" id="btnfileselect" class="btn btn-info hvr-glow" value="Select File">
                                           </div>
                                           <div class="clearfix"></div>
                                           <a id="linkFileName" href="#" target="_blank"></a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12 text-right">
                           <input type="submit" class="btn btn-warning hvr-glow" value="Submit" id="btnsave">
                       </div>
                   </div>
               </div>
           </form>
           
          </div>
       </div>
    </div>
    <iframe src="Upload.aspx" id="ifuploadfile" style="display: none;"></iframe>
    <script src="MasterJs/Attachment.js?v=1"></script>
    <script src="UserJs/Transactions/AddFund.js?version=04112022"></script>
 </div>

@include('includes.footer');


<script>
   function openQRCodePopup() {
   document.getElementById("qrCodePopup").style.display = "block";
}

function closeQRCodePopup() {
   document.getElementById("qrCodePopup").style.display = "none";
}

// Close the popup when clicking outside of the popup content
window.onclick = function(event) {
   var popup = document.getElementById("qrCodePopup");
   if (event.target == popup) {
       popup.style.display = "none";
   }
}
</script>
