<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\BandRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\{Band, Genre};

class BandController extends Controller
{
    
    public function table()
    {
        if(request()->expectsJson()){
            return Band::latest()->get(['id', 'name']);
        }


        return view('bands.table', [
            'bands' => Band::latest()->paginate(16)
        ]);
    }


    public function create()
    {
        $genres = Genre::get();
        return view('bands.create', [
            'genres' => Genre::get(),
            'band' => new Band,
            'submitLabel' => 'Create'
            ]
        );

    }

    public function store(BandRequest $request)
    {
        if(request()->file('thumbnail') == null) {
            $thumbnail = "";
        } else {
            $thumbnail = request()->file('thumbnail')->store('images/band');
        }

        $band = Band::create([
            'name' => $request->name,
            'slug' => Str::slug(request('name')),
            'thumbnail' => $thumbnail,

        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was created');

    }

    public function edit(Band $band)
    {
        // dd($band);
        return view('bands.edit', [
            'band' => $band,
            'genres' => Genre::get(),
            'submitLabel' => 'Edit'
        ]);
    }



    public function update(Band $band, BandRequest $request)
    {

        if(request('thumbnail')) {
            Storage::delete($band->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/band');
        } else if($band->thumbnail) {
            $thumbnail = $band->thumbnail;
        } else {
            $thumbnail = null;
        }

        $band->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => $thumbnail

        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was updated');

    }


    public function destroy(Band $band)
    {
        Storage::delete($band->thumbnail);
        $band->genres()->detach();
        $band->albums()->delete();
        $band->delete();
    }


}
