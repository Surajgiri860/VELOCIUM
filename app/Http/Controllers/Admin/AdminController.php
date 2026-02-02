<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use App\Exports\PayoutExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('Admin.Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Define credentials
        $credentials = $request->only('email', 'password');

        // Check if the user exists
        $user = Admin::where('email', $credentials['email'])->first();

        if ($user) {
            // Check if the entered password matches the hashed password
            if (Hash::check($request->password, $user->password)) {
                // Login the admin user with the 'admin' guard
                Auth::guard('admin')->login($user);

                // Redirect to admin dashboard
                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully');
            } else {
                Log::info('Incorrect password for Admin', ['email' => $credentials['email']]);
                return redirect()->route('login')->with('error', 'Password is incorrect');
            }
        }

        // If the user is not found
        Log::info('Admin not found', ['email' => $credentials['email']]);
        return redirect()->route('login')->with('error', 'Login credentials are not valid');
    }

    public function dashboard()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        // Monthly sums for the last month
        $monthlyInvestmentSum = User::where('created_at', '>=', $oneMonthAgo)
            ->sum('total_investment');

        $monthlyPayOutSum = User::where('created_at', '>=', $oneMonthAgo)
            ->sum('withdrawable');

        // Active users within the last month
        $activeUserCount = User::where('status', 2)
            ->where('created_at', '>=', $oneMonthAgo)
            ->count();

        // Total investment sum overall (not limited to the last month)
        $totalInvestmentSum = User::sum('total_investment');

        // Total payout for transactions of type 1 with status 2 in the last month
        $totalpayout = TransactionHistory::where('type', 1)
            ->where('status', 2)
            ->where('created_at', '>=', $oneMonthAgo) // Ensure this line to filter by last month
            ->sum('amount');

        // Total withdrawable sum from all users (not limited to the last month)
        $totalwithdralSum = User::sum('staking_balance')
            + User::sum('direct_balance')
            + User::sum('level_balance')
            + User::sum('royalty_balance');

        // Inactive users within the last month
        $inactiveUserCount = User::where('status', 0)
            ->where('created_at', '>=', $oneMonthAgo)
            ->count();

        // Total user count (not limited to the last month)
        $totalUserCount = User::count();

        return view('Admin.Dashboard', compact(
            'monthlyInvestmentSum',
            'activeUserCount',
            'totalpayout',
            'totalwithdralSum',
            'totalInvestmentSum',
            'inactiveUserCount',
            'totalUserCount',
            'monthlyPayOutSum'
        ));
    }

    public function payoutClosing()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Calculate the total balance for the user
            $totalBalance = $user->staking_balance
                + $user->direct_balance
                + $user->level_balance
                + $user->royalty_balance;
            // dd($totalBalance);
            // Update the user's withdrawable balance and reset individual balances
            $user->update([
                'withdrawable' => $user->withdrawable + $totalBalance, // Increment withdrawable
                'staking_balance' => 0, // Reset balances
                'direct_balance' => 0,
                'level_balance' => 0,
                'royalty_balance' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Payouts have been closed, and balances reset.');
    }

    public function showPayoutList()
        {
            $users = User::all();
            
            return view('Admin.payout_list', compact('users'));
        }



    public function show_all_user()
    {
        $alluser = User::paginate(100);
        return view('Admin.alluser', compact('alluser'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

   
   

}
