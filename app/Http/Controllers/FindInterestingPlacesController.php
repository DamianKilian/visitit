<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class FindInterestingPlacesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('find-interesting-places');
    }

    /**
     * Show place.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place($slug)
    {
        $place = Place::where('slug', $slug)->firstOrFail();
        return view('place', [
            'place' => $place
        ]);
    }
}
