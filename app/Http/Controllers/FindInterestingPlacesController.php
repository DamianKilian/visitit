<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use HTML_Sanitizer;

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
    public function place($slug, HTML_Sanitizer $san)
    {
        $place = Place::where('slug', $slug)->firstOrFail();
        $san->addAdditionalTags('<figure><figcaption>');
        $sanContent = $san->sanitize($place->content);
        return view('place', [
            'sanContent' => $sanContent
        ]);
    }
}
