@include('includes.header');

<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5>My Tree</h5>
                   <div class="btnRight"></div>
                   <div class="clearfix"></div>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                   <div class="form-group col-md-12">
                      <div id="divParentGroup" class="treecombo"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/CustomControl.js?version=0611022"></script>
    <script src="UserJs/Network/LevelTree.js?version=0611022"></script>
 </div>
@include('includes.footer');