<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class WalletAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('Pages.profile.UploadDocument', compact('user'));
    }

    public function requestOtp(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        // Validate request data
        $request->validate([
            'wallet_address' => 'required|string|min:10',
            'txtAccountName' => 'required|string|min:2',
            'txtAccountNumber' => 'required|string|min:5',
            'txtIFSC' => 'required|string|min:8',
        ]);

        // Generate OTP code and set expiry time
        $otpCode = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Check and update or create OTP in the database
        $user_otp = Otp::where('user_id', $user->id)->first();
        if ($user_otp) {
            $user_otp->otp = $otpCode;
            $user_otp->expires_at = $expiresAt;
            $user_otp->save();
        } else {
            Otp::create([
                'user_id' => $user->id,
                'otp' => $otpCode,
                'expires_at' => $expiresAt,
            ]);
        }

        // Store the data in session for validation later
        session([
            'pending_wallet_data' => [
                'wallet_address' => $request->wallet_address,
                'account_name' => $request->txtAccountName,
                'account_number' => $request->txtAccountNumber,
                'ifsc_code' => $request->txtIFSC,
            ]
        ]);

        // Send OTP to user's email
        $to = $user->email;

        if (empty($to) || empty($otpCode)) {
            return response()->json(['success' => false, 'message' => 'Failed to send email: Missing email or OTP.'], 500);
        }

        try {
            Log::info('Sending OTP Email', ['to' => $to, 'otp' => $otpCode]);
            Mail::to($to)->send(new OtpMail($otpCode));
            Log::info('OTP Email sent successfully.');
            return response()->json(['success' => true, 'message' => 'OTP sent to your email.']);
        } catch (\Exception $e) {
            Log::error('Email sending failed:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    public function validateOtp(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        // Validate OTP
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $otp = Otp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otp) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP.'], 400);
        }

        // Get pending data from session
        $pendingData = session('pending_wallet_data');
        
        if (!$pendingData) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please try again.'], 400);
        }

        // Update user details
        $user = User::findOrFail($user->id);
        $user->wallet_address = $pendingData['wallet_address'] ?? $user->wallet_address;
        $user->account_name = $pendingData['account_name'] ?? $user->account_name;
        $user->account_number = $pendingData['account_number'] ?? $user->account_number;
        $user->ifsc_code = $pendingData['ifsc_code'] ?? $user->ifsc_code;
        $user->save();

        // Clear session data
        session()->forget('pending_wallet_data');
        
        // Delete used OTP
        $otp->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Details updated successfully!'
        ]);
    }

    // Rest of the methods remain same...
}