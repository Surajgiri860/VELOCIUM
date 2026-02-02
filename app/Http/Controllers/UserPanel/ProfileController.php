<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_detail = User::where('id', auth()->id())->first();
        // dd($user_detail);
        return view('Pages.profile.index', compact('user_detail'));
    }
    // public function UploadDocument()
    // {
    //     return view('Pages.profile.UploadDocument');
    // }


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
        $User = User::find($id);
        // dd($request->name);
        $User->prefix = $request->prefix;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->gender = $request->gender;

        $User->save();
        return redirect()->route('profile.index')->with('success', 'profile Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
