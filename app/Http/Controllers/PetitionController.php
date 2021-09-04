<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Just in case, check if the user has logged in. If not, redirect to login page
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            // List all petitions created by the current User.
            $petitions = Petition::where('created_by', Auth::id())
                ->orderByDesc('created_at')
                ->get();
            return view('petitions.index', [
                'petitions' => $petitions,
            ]);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('petitions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if the user has loggied in
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            //Validation
            $request->validate([
                'title' => 'required'
            ]);

            $uid = Auth::id();

            $petition = Petition::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'created_by' => $uid,
            ]);

            //sign it too.
            $petition->signers()->attach($uid);

            return redirect()->route('home');
        }
        // Store input data to new petition
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function show(Petition $petition)
    {
        //
        return view('petitions.show', ['petition' => $petition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function edit(Petition $petition)
    {
        // Just in case, check if the user has logged in. If not, redirect to login page
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            // Pass the petition into edit page
            return view('petitions.edit', [
                'petition' => $petition,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petition)
    {
        // Check if the user has loggied in
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            //Validation
            $request->validate([
                'title' => 'required'
            ]);

            // $petition->title = $request->input('title');
            // $petition->description = $request->input('description');
            $petition->update([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
        }

        return redirect()->route('petition.show', ['petition' => $petition]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        // Check if the user has loggied in
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $petition->delete();
            return redirect()->route('home');
        }
    }

    public function sign(Petition $petition)
    {
        // Check if the user has loggied in
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $petition->signers()->attach(Auth::id());
        }
        return redirect()->route('petition.show', ['petition' => $petition]);
    }
}
