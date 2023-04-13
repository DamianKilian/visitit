<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\TrixAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Soundasleep\Html2Text;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Auth::user()->places()->withTrashed()->orderBy('id', 'desc')->paginate(10);
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
            'slug' => 'required|unique:places',
        ]);

        $place = new Place();
        $place->title = $request->title;
        $place->excerpt = $request->excerpt;
        $place->content = $request->content;
        $place->textContent = Html2Text::convert(str_replace("<br>", ' ', $request->content));
        $place->slug = $request->slug;
        $place->author_id = auth()->user()->id;
        DB::transaction(function () use ($place) {
            $place->save();
            $this->syncAttachments($place, $place->content);
        });
        return redirect()->route('places.index');
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
        $place = Place::withTrashed()->findOrFail($id);
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
            'slug' => 'required|unique:places,slug,' . $id,
        ]);
        $place = Place::with('trixAttachments')->withTrashed()->findOrFail($id);
        $this->authorize('update', $place);
        $place->title = $request->title;
        $place->excerpt = $request->excerpt;
        $place->content = $request->content;
        $place->textContent = Html2Text::convert(str_replace("<br>", ' ', $request->content));
        $place->slug = $request->slug;
        DB::transaction(function () use ($place) {
            $place->save();
            $this->syncAttachments($place, $place->content, $place->id);
        });
        return redirect()->route('places.index');
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
        return redirect()->route('places.index');
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
        return redirect()->route('places.index');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $place = Place::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $place);
        $place->forceDelete();
        return redirect()->route('places.index');
    }

    /**
     * If place slug is unique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function slugUnique(Request $request, $id = null)
    {
        $SlugExists = Place::withTrashed()->where('slug', '=', $request->slug)
            ->when($id, function ($query, $id) {
                $query->where('id', '!=', $id);
            })
            ->exists();
        return response()->json([
            'slug_availability' => $SlugExists ? 'unavailable' : 'available',
        ]);
    }

    /**
     * Handle loading attachment in create/edit form.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trixAttachment(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,svg,txt,pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $name = pathinfo($fileName, PATHINFO_FILENAME) . '-' . $file->hashName();

        $path = 'storage/' . $file->storeAs(
            'trix-attachments/' . date("Y"),
            $name,
            'public'
        );

        try {
            DB::beginTransaction();
            $trixAttachment = TrixAttachment::create([
                'name' => $name,
                'path' => $path,
                'file_name' => $fileName,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'user_id' => auth()->user()->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Storage::delete('public/' . $path);
            throw $e;
        }
        return response()->json([
            'id' => $trixAttachment->id,
            'url' => asset($path),
        ]);
    }

    /**
     * Retrieve attachments from content.
     * 
     * @param  string  $content
     * @param  int  $placeId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function retrieveAttachmentsFromContent(string $content, $placeId = null)
    {
        $dataTrixAttachment = [];
        $re = "/<figure[^>]*data-trix-attachment=\"({[^}]*})\"[^>]*>/";
        preg_match_all($re, $content, $matches);
        foreach ($matches[1] as $match) {
            $data = json_decode(html_entity_decode($match));
            $dataTrixAttachment[$data->id] = $data;
        }
        $trixAttachments = TrixAttachment::whereIn('id', array_keys($dataTrixAttachment))
            ->where('user_id', auth()->user()->id)
            ->where(function ($trixAttachments) use ($placeId) {
                if ($placeId) {
                    $trixAttachments->where('place_id', $placeId)
                        ->orWhereNull('place_id');
                } else {
                    $trixAttachments->whereNull('place_id');
                }
            })
            ->get();
        return $trixAttachments;
    }

    /**
     * Synchronize attachments.
     * 
     * @param  \App\Models\Place  $place
     * @param  string  $content
     * @param  int  $placeId
     * @return \App\Models\Place
     */
    public function syncAttachments(Place $place, string $content, $placeId = null)
    {
        if ($placeId && $place->trixAttachments->isNotEmpty()) {
            $place->trixAttachments()->update(['place_id' => null]);
        }
        $currAttachments = $this->retrieveAttachmentsFromContent($content, $placeId);
        if ($currAttachments->isNotEmpty()) {
            $place->trixAttachments()->saveMany($currAttachments);
        }
    }
}
