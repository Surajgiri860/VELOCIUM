<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PayoutClosing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Config;

use App\Models\TransactionHistory;
use Carbon\Carbon;
use App\Exports\PayoutExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;




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

    $grandTotalBalance = 0;
    $grandWithdrawable = 0;

    foreach ($users as $user) {

        $totalBalance = $user->staking_balance
            + $user->direct_balance
            + $user->level_balance
            + $user->royalty_balance;

        $finalWithdrawable = $user->withdrawable + $totalBalance;

        $grandTotalBalance += $totalBalance;
        $grandWithdrawable += $finalWithdrawable;

        $user->update([
            'withdrawable' => $finalWithdrawable,
            'staking_balance' => 0,
            'direct_balance' => 0,
            'level_balance' => 0,
            'royalty_balance' => 0,
        ]);
    }

    // Unique file name
    $fileName = 'payout_' . now()->format('Y_m_d_H_i_s') . '.xlsx';

    // Store Excel in storage/app/public/payouts
    Excel::store(new PayoutExport, 'payouts/' . $fileName, 'public');

    // Save in database
    PayoutClosing::create([
        'total_balance' => $grandTotalBalance,
        'total_withdrawable' => $grandWithdrawable,
        'file_path' => 'payouts/' . $fileName,
    ]);

    return back()->with('success', 'Payout Closed & File Saved Successfully');
}

public function downloadLatestPayout()
{
    $payout = PayoutClosing::latest()->first();

    if (!$payout) {
        return back()->with('error', 'No payout file found.');
    }

    return Storage::disk('public')->download($payout->file_path);
}



public function showPayoutList()
{
    $users = User::all();
    $payoutClosings = PayoutClosing::latest()->get(); // 👈 ADD THIS
    
    return view('Admin.payout_list', compact('users','payoutClosings'));
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
public function toggleUserStatus($id)
{
    $user = User::findOrFail($id);

    // 2 = Active, 0 = Inactive
    $user->status = $user->status == 2 ? 0 : 2;
    $user->save();

    return response()->json([
        'success' => true,
        'status'  => $user->status,
        'message' => $user->status == 2
            ? 'User Unblocked Successfully'
            : 'User Blocked Successfully'
    ]);
}
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'wallet_address' => $request->wallet_address,
        'status' => $request->status,
    ]);

    // Agar admin password change kare
    if ($request->filled('password')) {
        $user->update([
            'password' => $request->password
        ]);
    }

    return redirect()->route('admin.show_all_user')
        ->with('success', 'User Updated Successfully');
}



public function settings()
{
    $config = Config::first();

    if (!$config) {
        $config = Config::create([
            'admin_address' => '',
            'direct_sponser' => 0,
            'min_deposit' => 0,
            'min_wothdrawal' => 0,
            'admin_charge' => 0
        ]);
    }

    return view('admin.settings', compact('config'));
}

public function updateSettings(Request $request)
{
    $request->validate([
        'admin_address' => 'required|string|max:255'
    ]);

    $config = Config::first();

    if ($config) {
        $config->update([
            'admin_address' => $request->admin_address
        ]);
    }

    return back()->with('success', 'Admin address updated successfully!');
}
    

}
