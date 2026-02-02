<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $direct_income = TransactionHistory::with('user.investmentHistory')
            ->where('user_id', auth()->id())
            ->where('type', 4)
            ->paginate(10);
        return view('Pages.Incomes.ReportROI', compact('direct_income'));
    }
    public function DirectIncome()
    {
        // Change this to paginate, e.g., 10 items per page
        $direct_income = TransactionHistory::with('user.investmentHistory')
            ->where('to', auth()->id())
            ->where('type', 5)
            ->paginate(10); // Number of items per page

        return view('Pages.Incomes.DirectIncome', compact('direct_income'));
    }

    public function LevelIncome(Request $request)
    {
        // Use pagination, e.g., 10 records per page
        $level_income = TransactionHistory::with('user.investmentHistory')
            ->where('to', auth()->id())
            ->where('type', 2)
            ->paginate(10); // Change the number to set how many items per page

        return view('Pages.Incomes.Level_Income', compact('level_income'));
    }

    public function ReportROILevelIncome()
    {
        return view('Pages.Incomes.ReportROILevelIncome');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
