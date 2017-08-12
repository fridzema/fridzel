<?php

namespace App\Http\Controllers;

use Cache;
use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PhotosController extends Controller
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

        return response()->view('admin.photos.index', ['photos' => $photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->file('file') as $requestFile) {
            $exif_data = [];
            $iptc_data = [];
            $intervention_image = Image::make($requestFile->getRealPath());
            $exif_data = ($intervention_image->exif()) ? json_encode($intervention_image->exif()) : null;
            $iptc_data = ($intervention_image->iptc()) ? json_encode($intervention_image->iptc()) : null;

            $photo = new Photo();
            $photo->filename = $requestFile->getClientOriginalName();
            $photo->exif = $exif_data;
            $photo->iptc = $iptc_data;
            $photo->addMedia($requestFile)->toMediaCollection('images');
            $photo->save();
        }

        Cache::flush();

        return response()->json(['success' => true]);
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->forceDelete();

        Cache::flush();

        return redirect()->back();
    }
}
