<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return 'it works';
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
