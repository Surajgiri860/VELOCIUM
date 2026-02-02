{{-- resources/views/Pages/Incomes/DirectIncome.blade.php --}}
@include('includes.header')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card smallPageHeader">
                <div class="card-header ">
                    <div class="divPageTitle">
                        <h5 id="pagetitle" class="text-center">Direct Income</h5> <!-- Center title -->
                        <div class="btnRight"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body form_design">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tbldata_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="dataTables_scroll">
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%; max-height: 500px;">
                                        <table id="tbldata" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="tbldata_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="text-center" aria-label="Date: activate to sort column ascending">Date</th>
                                                    <th class="text-center" aria-label="Referred User: activate to sort column ascending">Referred User</th>
                                                    <th class="text-center" aria-label="Amount">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($direct_income->count())
                                                    @foreach($direct_income as $income)
                                                        <tr>
                                                            <td class="text-center">{{ $income->created_at }}</td>
                                                            <td class="text-center">{{ $income->user->referal_code }}</td>
                                                            <td class="text-center">{{ $income->amount }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3" class="text-center">No data found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_info" id="tbldata_info" role="status" aria-live="polite">Showing 
                                 {{ $direct_income->firstItem() }} to {{ $direct_income->lastItem() }} of {{ $direct_income->total() }} entries</div>
                                <div class="dataTables_paginate paging_simple_numbers" id="tbldata_paginate">
                                    {{ $direct_income->links('pagination::bootstrap-4') }} <!-- Use bootstrap-4 for Bootstrap pagination -->
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
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Reports/DirectIncome.js?version=17082022"></script>
</div>

@include('includes.footer')
