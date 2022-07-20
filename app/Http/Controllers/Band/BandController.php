<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Genre;
use App\Models\Band;

class BandController extends Controller
{
    
    public function table()
    {
        return view('bands.table', [
            'bands' => Band::latest()->paginate(16)
        ]);
    }


    public function create()
    {
        $genres = Genre::get();
        return view('bands.create', [
            'genres' => Genre::get(),

            ]
        );

    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:bands,name',
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png,gif' : '',
            'genres' => 'required|array'
        ]);

        $band = Band::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => request()->file('thumbnail')->store('images/band'),

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
        ]);
    }



    public function update(Band $band)
    {
        request()->validate([
            'name' => 'required|unique:bands,name,' . $band->id,
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png,gif' : '',
            'genres' => 'required|array'
        ]);


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
        $band->delete();
    }


}
