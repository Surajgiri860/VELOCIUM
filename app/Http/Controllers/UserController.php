<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvestmentHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function showLoginForm()
    {
        return view('auth.Login');
    }
    public function showRegisterForm()
    {
        return view('auth.Register');
    }
    public function register(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'prefix' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:4|confirmed',
            'referal_by' => 'required|string|max:50|nullable',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'Please enter a valid email address.',
            'phone.required' => 'Phone number is required.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Check if referral code exists
        if (!empty($request->referal_by)) {
            $referalUser = User::where('referal_code', $request->referal_by)->first();

            if (is_null($referalUser)) {
                return redirect()->back()->withErrors(['referal_by' => 'Referral code is invalid.']);
            }
        }
        try {
            DB::beginTransaction();
            $password = Hash::make($validated['password']);
            Log::info('genrate password ', ['hashed_password' => $password]);
            Log::info('Entered password', ['entered_password' => $request->password]);
            // echo $request->password;
            // die;
            // Create the user
            //return redirect('/register')->with('error', 'Server Error');
            $user = User::create([
                'prefix' => $validated['prefix'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => "0",
                'type' => "1",
                'password' => $password,
                'referal_code' => "VEL" . random_int(100000, 999999),
                'referal_by' => $request->referal_by, // Save referral user ID if available
            ]);
            // dd($user);
            Log::info('User password from DB', ['hashed_password' => $user->password]);
            DB::commit();
            // Log in the user after registration (optional)
            auth()->login($user);

            session([
                'username' => $user->name,
                'loginId' => $user->referal_code,
                'password' => $validated['password'], // or a random generated password
            ]);

            return redirect()->route('register')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Optionally handle the exception
            DB::rollBack();
            return response()->json(['register' => 'Register failed', 'message' => $e->getMessage()], 500);
        }
    }
    public function clearSession(Request $request)
    {
        // Clear specific session variables
        $request->session()->forget(['username', 'loginId', 'password']);

        return response()->json(['status' => 'success']);
    }



    public function login(Request $request)
    {



        $request->validate([
            'referal_code' => 'required',
            'password' => 'required',
        ]);

        // Define credentials
        $credentials = $request->only('referal_code', 'password');

        // Check if the user exists
        $user = User::where('referal_code', $credentials['referal_code'])->first();

        // echo Hash::make(12341234);
        //die;
        if ($user) {
            // echo Hash::check($credentials['password'], $user->password);
            // die;
            // Check if the entered password matches the hashed password
            if (Hash::check($request->password, $user->password)) {

                // Proceed with login
                Auth::login($user);
                return redirect()->intended('dashboard');
                // return redirect('/login')->with('error', 'Server Error');
            } else {
                Log::info('Incorrect password for user', ['referal_code' => $credentials['referal_code']]);
                return redirect('/login')->with('error', 'Password is incorrect');
            }
        }

        // If the user is not found
        Log::info('User not found', ['referal_code' => $credentials['referal_code']]);
        return redirect('/login')->with('error', 'Login credentials are not valid');
    }

    public function getSponsorName(Request $request)
    {
        $sponsorId = $request->input('referal_by');

        // Assuming you have a field 'referal_code' in your users table
        $user = User::where('referal_code', $sponsorId)->first();

        if ($user) {
            return response()->json(['name' => $user->name]); // Adjust 'name' to match your User model's field
        }

        return response()->json(['name' => '']); // Return empty if not found
    }



    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect('/login'); // Redirect to home or login page
    }
}
