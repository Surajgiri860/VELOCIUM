@include('includes.header')

<div class="content">
    <div class="row">
       <div class="col-md-12">
          <div class="card smallPageHeader">
             <div class="card-header">
                <div class="divPageTitle">
                   <h5 id="pagetitle">Team List</h5>
                </div>
             </div>
             <div class="card-body form_design">
                <div class="row">
                  <form id="levelForm" method="GET" action="{{ route('TeamList') }}">
                     <div class="form-group col-md-2">
                         <select id="dropLevelNoSrch" name="level" class="form-control custom-select" onchange="document.getElementById('levelForm').submit();" style="width: 100px;">
                             @for ($i = 1; $i <= 20; $i++)
                                 <option value="{{ $i }}" {{ $selectedLevel == $i ? 'selected' : '' }}>Level-{{ $i }}</option>
                             @endfor
                         </select>
                     </div>
                 </form>
                </div><br>

                <div class="row">
                  <div class="col-md-12">
                      <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                          <div class="dataTables_scroll">
                              <div class="dataTables_scrollBody" style="overflow: auto; max-height: 500px;">
                                  <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Package</th>
                                              <th>Status</th>
                                              <th>Date of Activation</th>
                                              <th>Level</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($allUsers as $user)
                                        <tr>
                                            <td>{{ $user->referal_code }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->investmentHistories?->sum('amount') ?? 0 }}</td>

                                            <td style="{{ $user->status == 0 ? 'color: rgb(247, 19, 19)' : 'color: rgb(27, 232, 27)' }}">
                                                {{ $user->status == 0 ? 'InActive' : 'Active' }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>Level {{ $user->level ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="dataTables_info" id="tbldata_info" role="status" 
                                aria-live="polite">Showing {{ $allUsers->firstItem() }}
                                 to {{ $allUsers->lastItem() }} of {{ $allUsers->total() }} 
                                 entries
                                </div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    {{ $allUsers->links('pagination::bootstrap-4') }}
                                </div>
                      </div>
                  </div>
              </div>
             </div>
          </div>
       </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Network/TeamList.js?version=05112022"></script>
</div>

@include('includes.footer')
