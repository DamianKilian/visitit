<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Auth::user()->places()->withTrashed()->paginate(10);
        return view('account.places.index', [
            'places' => $places,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'slug' => 'required',
        ]);

        $place = new Place();
        $place->title = $request->title;
        $place->excerpt = $request->excerpt;
        $place->content = $request->content;
        $place->slug = $request->slug;
        $place->author_id = auth()->user()->id;
        $place->save();

        return redirect()->route('places.index', $place->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Place $place)
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $this->authorize('update', $place);
        return view('account.places.edit', [
            'place' => $place,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'slug' => 'required',
        ]);

        $place = Place::findOrFail($id);
        $this->authorize('update', $place);
        $place->title = $request->title;
        $place->excerpt = $request->excerpt;
        $place->content = $request->content;
        $place->slug = $request->slug;
        $place->save();

        return redirect()->route('places.index', $place->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $this->authorize('delete', $place);
        $place->delete();
        return redirect()->route('places.index', $place->id);
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $place = Place::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $place);
        $place->restore();
        return redirect()->route('places.index', $place->id);
    }
}
