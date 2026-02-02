
{{-- include header --}}
@include('layouts.header');
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Closing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        h2 {
            color:rgb(235, 238, 242);
            font-weight: 600;
            margin-bottom: 30px;
        }
        .table {
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .table thead th {
            background-color: #2c3e50;
            color: white;
            font-weight: 500;
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .table tfoot th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-success, .btn-secondary {
            padding: 12px 40px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40,167,69,0.3);
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108,117,125,0.3);
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    @section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Payout Closing - User List</h2>
        <!-- <div class="text-center mt-4">
            <form action="{{ route('payout.closing') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-lg btn-success">Process Payout</button>
            </form>
            
        </div> -->

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Total Balance ($)</th>
                        <th>Withdrawable Balance ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotalBalance = 0;
                        $grandWithdrawableBalance = 0;
                    @endphp
                    @foreach($users as $user)
                        @php
                            $totalBalance = $user->staking_balance + $user->direct_balance + $user->level_balance + $user->royalty_balance;
                            $withdrawableBalance = $user->withdrawable + $totalBalance;

                            $grandTotalBalance += $totalBalance;
                            $grandWithdrawableBalance += $withdrawableBalance;
                        @endphp
                        <tr>
                            <td><strong>{{ $user->referal_code }}</strong></td>
                            <td>{{ $user->name }}</td>
                            <td>${{ number_format($totalBalance, 2) }}</td>
                            <td>${{ number_format($withdrawableBalance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="2" class="text-right">Total:</th>
                        <th>${{ number_format($grandTotalBalance, 2) }}</th>
                        <th>${{ number_format($grandWithdrawableBalance, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-4">
            <form action="{{ route('payout.closing') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-lg btn-success">Process Payout</button>
            </form>
            
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
{{-- include footer --}}
@include('layouts.footer');