<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class JobApplicationController extends Controller
{
    public function apply(Listing $listing)
    {
        return view('listings.apply', ['listing' => $listing]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'location'=>'required|string|max:255',
            'projects'=>'nullable',
            'cover_letter' => 'nullable|string',
            'cv_path'=> 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv_path')->store('cvs', 'public');

        JobApplication::create([
            'user_id' => auth()->id(),
            'listing_id' => $request->listing_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'location'=>$request->location,
            'projects'=>$request->projects,
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
        ]);
        $listing = Listing::findOrFail($request->listing_id);


        return redirect()->route('listings.show', $listing)
                         ->with('success', 'Application submitted successfully.');

    }
}
