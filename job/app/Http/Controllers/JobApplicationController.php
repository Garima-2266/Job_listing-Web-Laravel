<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class JobApplicationController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'cover_letter' => 'nullable|string',
        ]);

        $application = JobApplication::create([
            'user_id' => auth()->id(),
            'listing_id' => $request->listing_id,
            'cover_letter' => $request->cover_letter,
        ]);
        $listing = Listing::findOrFail($request->listing_id);


        return redirect()->route('listings.show', $listing)
                         ->with('success', 'Application submitted successfully.');
    }
}
