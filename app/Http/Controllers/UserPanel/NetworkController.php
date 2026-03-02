<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\TransactionHistory;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        // Fetch direct income with pagination
        $DirectTeam = User::with('investmentHistory')
            ->where('referal_by', $user->referal_code)
            ->paginate(10); // Change the number 10 to your desired number of items per page

        return view('Pages.network.DirectTeam', compact('DirectTeam'));
    }




    public function TeamList(Request $request)
    {
        $user_data = User::where('id', auth()->id())->first();
        $selectedLevel = $request->input('level', 1);
        // Initialize collection to store all users
        $allUsers = collect();

        // Start with the user's referral code
        $currentReferalCodes = collect([$user_data->referal_by]);

        // Loop through levels up to the max level (20) or requested level
        for ($i = 1; $i <= 30; $i++) {
            $users = User::whereIn('referal_by', $currentReferalCodes)->get();

            if ($users->isEmpty()) {
                break; // Stop if there are no users at this level
            }

            // Assign the level to each user for display purposes
            $users->each->setAttribute('level', $i);
            $allUsers = $allUsers->merge($users);

            // Prepare referral codes for the next level
            $currentReferalCodes = $users->pluck('id');

            if ($selectedLevel == $i) {
                // Paginate users at the specific selected level
                $paginatedUsers = $this->paginateCollection($users, 10); // 10 items per page
                return view('Pages.network.TeamList', [
                    'allUsers' => $paginatedUsers,
                    'selectedLevel' => $selectedLevel,
                ]);
            }
        }

        // Paginate all users if 'All' levels are selected
        $paginatedAllUsers = $this->paginateCollection($allUsers, 10); // 10 items per page
        return view('Pages.network.TeamList', [
            'allUsers' => $paginatedAllUsers,
            'selectedLevel' => $selectedLevel
        ]);
    }

    /**
     * Paginate a Collection manually.
     *
     * @param Collection $collection
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function paginateCollection(Collection $collection, $perPage)
    {
        $page = request()->input('page', 1);

        // Calculate the total number of items
        $total = $collection->count();

        // Slice the collection to get the items for the current page
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        // Create a LengthAwarePaginator instance
        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => request()->url(),      // Current URL
            'query' => request()->query(),    // Query parameters
        ]);
    }




    public function LevelTree()
    {
        return view('Pages.network.LevelTree');
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
