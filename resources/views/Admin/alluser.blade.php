@include('layouts.header')

<div class="content">
    <div class="row">
        <div class="col-md-12 text-right"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" id="pagetitle">All User List</h5>
                    <div class="input-group mb-3">
                        <input type="text" id="searchUser" class="form-control" placeholder="Search by Referral Code" aria-label="Search by Referral Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="searchUserByReferral()">Search</button>
                        </div>
                    </div>
                </div>
                <div class="card-body form_design">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="dataTables_scroll">
                                    <div class="dataTables_scrollBody" style="overflow: auto; max-height: 500px;">
                                        <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                            <thead>
                                                <tr>
                                                    <th>User Id</th>
                                                     <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Referred By</th>
                                                    <th>Activation Balance</th>
                                                    <th>Withdrawable</th>
                                                    <th>Type</th>
                                                    <th>Staking Balance</th>
                                                    <th>Direct Balance</th>
                                                    <th>Level Balance</th>
                                                    <th>Total Investment</th>
                                                    <th>Royalty Balance</th>
                                                    <th>Team Business</th>
                                                    <th>Status</th>
                                                    <th>Wallet Address</th>
                                                    <th>Date of Activation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="userTableBody">
                                                @foreach($alluser as $user)
                                                <tr>
                                                    <td class="referral-code"><strong>{{ $user->referal_code }}</strong></td>
                                                    
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->referal_by }}</td>
                                                    <td>${{ number_format($user->activation_balance, 2) }}</td>
                                                    <td>${{ number_format($user->withdrawable, 2) }}</td>
                                                    <td>{{ $user->type == 1 ? 'Paid' : 'Dummy ID' }}</td>
                                                    <td>${{ number_format($user->staking_balance, 2) }}</td>
                                                    <td>${{ number_format($user->direct_balance, 2) }}</td>
                                                    <td>${{ number_format($user->level_balance, 2) }}</td>
                                                    <td>${{ number_format($user->total_investment, 2) }}</td>
                                                    <td>${{ number_format($user->royalty_balance, 2) }}</td>
                                                    <td>${{ number_format($user->team_business, 2) }}</td>
                                                    <td class="user-status">
                                                        <span style="color: {{ $user->status == 2 ? 'green' : 'red' }}">
                                                            {{ $user->status == 2 ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $user->wallet_address }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                       <button 
                                                        class="btn btn-sm {{ $user->status == 2 ? 'btn-danger' : 'btn-success' }}"
                                                        onclick="toggleUserStatus({{ $user->id }}, this)">
                                                        {{ $user->status == 2 ? 'Block' : 'Unblock' }}
                                                    </button>
                                                    <a href="{{ route('admin.user.edit', $user->id) }}" 
                                                            class="btn btn-sm btn-primary">
                                                            Edit
                                                            </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_info" id="tbldata_info" role="status" 
                                aria-live="polite">Showing {{ $alluser->firstItem() }}
                                 to {{ $alluser->lastItem() }} of {{ $alluser->total() }} 
                                 entries
                                </div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    {{ $alluser->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divDataloader" style="text-align: center; display: none;">
                        <img src="images/smallLoader.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="UserJs/Network/DirectTeam.js?version=17082022"></script>
    <script>
        function searchUserByReferral() {
            var input = document.getElementById("searchUser").value.toUpperCase();
            var table = document.getElementById("userTableBody");
            var tr = table.getElementsByTagName("tr");
            
            if (input === "") {
                for (var i = 0; i < tr.length; i++) {
                    tr[i].style.display = "";
                }
                return;
            }

            for (var i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByClassName("referral-code")[0];
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(input) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        function toggleUserStatus(userId, btn) {
    if (!confirm('Are you sure?')) return;

    fetch("{{ url('admin/user-toggle-status') }}/" + userId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
             // 🔄 Auto refresh after status change
            setTimeout(() => {
                location.reload();
            }, 500); // 0.5 second delay

            if (data.status == 1) {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-danger');
                btn.innerText = 'Block';
            } else {
                btn.classList.remove('btn-danger');
                btn.classList.add('btn-success');
                btn.innerText = 'Unblock';
            }

            // Status text update
            let statusSpan = btn.closest('tr').querySelector('.user-status span');

                if (statusSpan) {
                    if (data.status == 2) {
                        statusSpan.innerText = 'Active';
                        statusSpan.style.color = 'green';
                    } else {
                        statusSpan.innerText = 'Inactive';
                        statusSpan.style.color = 'red';
                    }
                }
        }
    });
}   
    </script>
</div>

@include('layouts.footer')
