<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        $listings = Listing::with('user')->latest()->filter(request(['tag', 'search']))->paginate(5);

        return view('listings.index', compact('listings'));
    }

    //show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
            // 'listing' => $listing->load('user')
    }

    //show create form
    public function create()
    {
        return view('listings.create');
    }

    //store Listing Data
    public function store(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Ensure the user is authenticated
        if (Auth::check()) {
            $formFields['user_id'] = Auth::id();
        } else {
            return redirect('/login')->with('message', 'Please login to create a listing.');
        }

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        // Session::flash('message','Listings created!');

        return redirect('/')->with('message', 'Listings created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }


    //Update Listing Data
    public function update(Request $request, Listing $listing)
    {

        //Make sure logged in user is owner
        if($listing->user_id !=auth()->id()){
            abort(403,'Unauthorized Action');
        }


        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        // Session::flash('message','Listings created!');

        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing)
    {
        //Make sure logged in user is owner
        if($listing->user_id !=auth()->id()){
            abort(403,'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted successfully');
    }

    //Manage Listings
    public function manage()
    {
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
}
