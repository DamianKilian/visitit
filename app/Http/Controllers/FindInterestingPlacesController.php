<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use HTML_Sanitizer;
use App\Services\DbFind\AutocompleteService as DbFindAutocompleteService;
use App\Services\DbFind\DbFindService;

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

    /**
     * Autocomplete by search value.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request, DbFindAutocompleteService $autocomplete)
    {
        return response()->json([
            'autocomplete' => [$request->searchBarValue],
        ]);
    }

    /**
     * Get places by search value.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlaces(Request $request, DbFindService $find, DbFindAutocompleteService $autocomplete)
    {
        return response()->json([
            'places' => $find->dbFind($request->searchBarValue, 'places', ['title','excerpt','textContent'], null),
        ]);
    }
}
