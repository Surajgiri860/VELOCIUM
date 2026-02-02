@include('layouts.header')

<div class="content">
    <div class="row">
        <div class="offset-md-2 col-md-6">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <div class="divPageTitle">
                        <h5>Activate/Upgrade User ID</h5>
                        <div class="btnRight"></div>
                        <div class="clearfix"></div>
                       
                    </div>
                </div>
                <div class="row"  style="display: none;">
                    <div class="col-md-12 col-xs-12">
                        <div class="validate-box">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <div class="card-body form_design" >
                    <form action="{{ route('activation_user') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Activation User Id: </label>
                                        <input type="text" name="user_id" class="form-control" maxlength="50" placeholder="Enter User Id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Package: *</label>
                                        <select name="package_id" class="form-control" required>
                                            @foreach($all_packages as $package)
                                                <option value="{{ $package->id }}">Package of ${{ $package->amount }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-warning hvr-glow">
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/search.js"></script>
    <script src="UserJs/Network/ActivateMyID.js?version=4"></script>
</div>

@include('layouts.footer')



