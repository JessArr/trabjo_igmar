<?php

namespace App\Http\Controllers\Discografica;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function Show()
    {
        $albums = Album::all();
        return Inertia::render('Discografica/Album/Index', [
            'objeto' => $albums,
            'editarRoute' => '/EditAlbum',
            'eliminarRoute' => '/DestroyAlbum',
            'crearRoute' => '/CreateAlbum'
        ]);
    }
    public function Create()
    {
        return Inertia::render('Discografica/Album/Store', ['rout' => '/StoreAlbum' , 'routArtistas' => '/Artistas']);
    }
    public function Store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'release_date' => 'required',
            'description' => 'required|min:3|max:50',
            'artist_id' => 'required | integer'
        ]);

        $album = new Album();
        $album->title = $request->title;
        $album->release_date = $request->release_date;
        $album->description = $request->description;
        $album->artist_id = $request->artist_id;
        $album->save();

        return redirect('/ShowAlbums');
    }
    public function Edit(Request $request)
    {
        $album = Album::find($request->id);
        return Inertia::render('Discografica/Album/Update', ['objeto' => $album, 'rout' => '/UpdateAlbum', 'routArtistas' => '/Artistas']);
    }
    public function Update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'release_date' => 'required',
            'description' => 'required|min:3|max:50',
            'artist_id' => 'required | integer'
        ]);

        $album = Album::find($request->id);
        $album->title = $request->title;
        $album->release_date = $request->release_date;
        $album->description = $request->description;
        $album->artist_id = $request->artist_id;
        $album->save();

        return redirect('/ShowAlbums');
    }
    public function Destroy(Request $request)
    {
        $album = Album::find($request->id);
        $album->delete();
        return redirect('/ShowAlbums');
    }

}
