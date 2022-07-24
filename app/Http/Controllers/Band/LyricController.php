<?php

namespace App\Http\Controllers\Band;

use App\Models\Band;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class LyricController extends Controller
{
    
    public function table()
    {

    }

    public function create()
    {
        return view('lyrics.create', [
            'title' => 'New Lyric'
        ]);
    }

    public function store()
    {
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'body' => 'required',
            'title' => 'required',
        ]);

        $band = Band::find(request('band'));


        $band->lyrics()->create([
            'title' => request('title'),
            'slug' => Str::slug(request('slug')),
            'body' => request('body'),
            'album_id' => request('album'),

        ]);

        return response()->json(['message' => 'The lyrics was created into band ' . $band->name]);
    }

    public function edit()
    {

    }

    public function update()
    {

    }


    public function destroy()
    {

    }


}
