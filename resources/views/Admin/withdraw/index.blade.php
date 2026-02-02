@include('layouts.header')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center" id="pagetitle">Withdrawal Request History</h5>
                </div>
                <div class="card-body form_design">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="dataTables_scroll">
                                    <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                        <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 100%; padding-right: 0px;">
                                            <table class="table table-striped table-bordered dataTable no-footer text-center" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="text-center" style="
                                                                    width: 62px;
                                                                ">Name</th>
                                                        <th class="text-center" style="
                                                                    width: 133px;
                                                                ">Date</th>
                                                        <th class="text-center" style="
                                                                    width: 69px;
                                                                ">Amount</th>
                                                        <th class="text-center" style="
                                                                    width: 41px;
                                                                ">Status</th>
                                                        <th class="text-center">Address</th>
                                                        <th class="text-center">Account Holder Name</th>
                                                        <th class="text-center">Account Number</th>
                                                        <th class="text-center">IFSC Code</th>

                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                                        <table class="table table-striped table-bordered dataTable no-footer text-center" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                            <tbody>
                                                @if ($withdral_req->count() > 0)
                                                    @foreach($withdral_req as $req)
                                                    <tr class="odd">
                                                        <td class="text-center">{{$req->user_req->referal_code}}</td>
                                                        <td class="text-center">{{$req->created_at}}</td>
                                                        <td class="text-center">{{$req->amount}}</td>
                                                        <td class="text-center" style="color: {{ $req->status == 0 ? 'rgb(242, 233, 107)' : 'green' }}">
                                                            {{ $req->status == 0 ? 'Pending...' : 'Approved' }}
                                                        </td>
                                                        <td class="text-center">{{$req->withdrawal_address}}</td>
                                                        <td class="text-center">{{ $req->user_req->account_name ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $req->user_req->account_number ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $req->user_req->ifsc_code ?? 'N/A' }}</td>

                                                        <td class="text-center" style="width: 276.604px;" aria-label="Status">
                                                            <form action="{{ route('accept_withdraw_req', $req->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger hvr-sweep-to-right">Activate</button>
                                                            </form>
                                                            <form action="{{ route('withdrawal_requests.update', $req->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger hvr-sweep-to-right">Reject</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="odd">
                                                        <td valign="top" colspan="6" class="dataTables_empty text-center">No data found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Pagination Links -->
                                <div class="dataTables_paginate paging_simple_numbers pagination-center" id="tbldata_paginate">
                                    {{ $withdral_req->links() }}
                                </div>

                            </div>
                            <div id="divDataloader" style="text-align: center; display: none;">
                                <img src="images/smallLoader.gif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
