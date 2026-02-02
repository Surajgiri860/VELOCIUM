<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPanel\DashboardController;
use App\Http\Controllers\UserPanel\ProfileController;
use App\Http\Controllers\UserPanel\NetworkController;
use App\Http\Controllers\UserPanel\ActivateController;
use App\Http\Controllers\UserPanel\TransactionsController;
use App\Http\Controllers\UserPanel\RoyaltyRewardsController;
use App\Http\Controllers\UserPanel\IncomesController;
use App\Http\Controllers\UserPanel\WalletAddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InvestmentRequestController;
use App\Http\Controllers\Admin\AddFundController;
use App\Http\Controllers\Admin\WithdrawalRequestController;
use App\Http\Controllers\Admin\ActiveUserIdController;
use App\Mail\OtpMail;

// Public routes
Route::get('/', [UserController::class, 'index']);
Route::get('login', [UserController::class, 'showLoginForm']);
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/get-sponsor-name', [UserController::class, 'getSponsorName']);
Route::post('/clear-session', [UserController::class, 'clearSession'])->name('clear.session');
Route::get('/claimDaily', [ActivateController::class, 'claimDaily'])->name('claimDaily');
Route::get('/level_income', [ActivateController::class, 'level_income'])->name('level_income');
// Protected routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/UploadDocument', [ProfileController::class, 'UploadDocument'])->name('UploadDocument');
    Route::get('/TeamList', [NetworkController::class, 'TeamList'])->name('TeamList');
    Route::get('/LevelTree', [NetworkController::class, 'LevelTree'])->name('LevelTree');
    Route::get('/WithdrawalRequest', [TransactionsController::class, 'index'])->name('WithdrawalRequest');
    Route::get('/DepositHistory', [TransactionsController::class, 'DepositHistory'])->name('DepositHistory');
    Route::get('/WithdrawalHistory', [TransactionsController::class, 'WithdrawalHistory'])->name('WithdrawalHistory');
    Route::get('/TransactionSummary', [TransactionsController::class, 'TransactionSummary'])->name('TransactionSummary');
    Route::get('/addfund', [TransactionsController::class, 'addfund'])->name('addfund');
    Route::get('/ReportROI', [IncomesController::class, 'index'])->name('ReportROI');
    Route::get('/DirectIncome', [IncomesController::class, 'DirectIncome'])->name('DirectIncome');
    Route::get('/LevelIncome', [IncomesController::class, 'LevelIncome'])->name('LevelIncome');
    Route::get('/ReportROILevelIncome', [IncomesController::class, 'ReportROILevelIncome'])->name('ReportROILevelIncome');
    Route::post('/invest', [ActivateController::class, 'invest'])->name('invest');
    Route::post('/withdraw', [TransactionsController::class, 'withdraw'])->name('withdraw');
    Route::get('/Royalty', [RoyaltyRewardsController::class, 'Royalty'])->name('Royalty');
    Route::post('/claim-reward/{reward}', [RoyaltyRewardsController::class, 'claimReward'])->name('claim.reward');
    Route::post('/add-fund-request', [TransactionsController::class, 'addfundrequest'])->name('add.fund.request');



    Route::get('/getIndirectReferrals', [DashboardController::class, 'getIndirectReferrals'])->name('getIndirectReferrals');

    // routes/web.php
    Route::post('/request-otp', [WalletAddressController::class, 'requestOtp'])->name('request-otp');

    Route::post('/validate-otp', [WalletAddressController::class, 'validateOtp']);


    // Resource routes with 'auth' middleware
    Route::resource('profile', ProfileController::class);
    Route::resource('UploadDocument', WalletAddressController::class);
    Route::resource('Network', NetworkController::class);
    Route::resource('Activate', ActivateController::class);
});
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm']);
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    // In routes/web.php
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Add other admin routes that require authentication
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/active', [InvestmentRequestController::class, 'active'])->name('admin.active');
        Route::get('/reject', [InvestmentRequestController::class, 'reject'])->name('admin.reject');
        Route::put('/reject_request/{id}', [InvestmentRequestController::class, 'reject_request'])->name('reject_request');
        Route::put('/accept_request/{id}', [AddFundController::class, 'accept_request'])->name('accept_request');
        Route::put('/activation_user', [ActiveUserIdController::class, 'activation_user'])->name('activation_user');
        Route::get('/dummy_id', [ActiveUserIdController::class, 'dummy_id'])->name('dummy_id');
        Route::put('/active_dummy_id', [ActiveUserIdController::class, 'active_dummy_id'])->name('active_dummy_id');
        Route::get('/show_all_user', [AdminController::class, 'show_all_user'])->name('admin.show_all_user');
       // Route::post('/update-user-status', [AdminController::class, 'updateUserStatus'])->name('update.user.status');

        // routes/web.php
        Route::get('/payout-list', [AdminController::class, 'showPayoutList'])->name('admin.payoutList');
        Route::post('/payout-closing', [AdminController::class, 'payoutClosing'])->name('payout.closing');
       
        Route::put('/withdraw/accept/{id}', [WithdrawalRequestController::class, 'acceptWithdrawRequest'])->name('accept_withdraw_req');
        Route::resource('invest_req', InvestmentRequestController::class);
        Route::resource('addfund', AddFundController::class);
        Route::resource('active_user_id', ActiveUserIdController::class);
        Route::resource('withdrawal_requests', WithdrawalRequestController::class);
    });
});
