@include('layouts.header')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Admin Wallet Address Settings</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Admin Wallet Address</label>
                    <input type="text" 
                           name="admin_address" 
                           class="form-control" 
                           value="{{ $config->admin_address ?? '' }}"
                           required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Update Address
                </button>

            </form>

        </div>
    </div>
</div>

@include('layouts.footer')