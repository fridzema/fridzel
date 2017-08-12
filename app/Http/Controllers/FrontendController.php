<?php

namespace App\Http\Controllers;

use Cache;
use App\Photo;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Cache::rememberForever('photos', function () {
            return Photo::all();
        });
        $response = (count($photos)) ? response()->view('frontend.photos.index', ['photos' => $photos]) : redirect()->route('login');

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($photo_id)
    {
        $photo = Cache::rememberForever('photo_'.$photo_id, function () use ($photo_id) {
            return Photo::find($photo_id);
        });

        return response()->view('frontend.photos.show', ['photo' =>  $photo]);
    }
}
