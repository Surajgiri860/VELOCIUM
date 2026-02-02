@include('includes.header')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <div class="divPageTitle">
                        <h5 id="pagetitle">Level Income</h5>
                        <div class="btnRight"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body form_design">
                    <div class="row">
                        <!-- Your filter inputs here -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="martop0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="dataTables_scroll">
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                                        <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 86.7708px; text-align: center;">Date</th>
                                                    <th style="width: 269.021px; text-align: center;">Referred User</th>
                                                    <th style="width: 234.8646px; text-align: center;">Amount</th>
                                                    <th style="width: 234.8646px; text-align: center;">Level</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($level_income->count())
                                                    @foreach($level_income as $income)
                                                    <tr class="odd">
                                                        <td style="text-align: center;">{{ $income->created_at }}</td>
                                                        <td style="text-align: center;">{{ $income->user->referal_code }}</td>
                                                        <td style="text-align: center;">{{ $income->amount }}</td>
                                                        <td style="text-align: center;">Level {{ $income->level }}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="odd">
                                                        <td valign="top" colspan="4" class="dataTables_empty">No data found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing {{ $level_income->firstItem() }} to {{ $level_income->lastItem() }} of {{ $level_income->total() }} entries</div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    {{ $level_income->links('pagination::bootstrap-4') }} <!-- Use bootstrap-4 for Bootstrap pagination -->
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
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Reports/DirectIncome.js?version=17082022"></script>
</div>
@include('includes.footer');
