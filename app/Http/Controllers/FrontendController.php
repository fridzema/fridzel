<?php

namespace App\Http\Controllers;

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
        $photos = Photo::all();

        return (count($photos)) ? response()->view('frontend.photos.index', ['photos' => $photos]) : redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);

        return response()->view('frontend.photos.show', ['photo' =>  $photo]);
    }
}
