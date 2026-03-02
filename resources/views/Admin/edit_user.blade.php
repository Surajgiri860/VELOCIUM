@include('layouts.header')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">

            <form method="POST" 
                  action="{{ route('admin.user.update', $user->id) }}">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" 
                        value="{{ $user->name }}" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" 
                        value="{{ $user->email }}" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" 
                        value="{{ $user->phone }}" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Wallet Address</label>
                    <input type="text" name="wallet_address" 
                        value="{{ $user->wallet_address }}" 
                        class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

               

                <br>
                <button class="btn btn-success">
                    Update User
                </button>

            </form>

        </div>
    </div>
</div>

@include('layouts.footer')