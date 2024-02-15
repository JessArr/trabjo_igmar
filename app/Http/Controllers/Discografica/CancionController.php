<?php

namespace App\Http\Controllers\Discografica;

use App\Http\Controllers\Controller;
use App\Models\Cancion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CancionController extends Controller
{
    public function Show()
    {
        $cancion = Cancion::all();
        return Inertia::render('Discografica/Cancion/Index',['objeto' => $cancion,'editarRoute'=>'/EditCancion', 'eliminarRoute'=>'/DestroyCancion','crearRoute'=>'/CreateCancion']);
    }
    public function Create()
    {
        return Inertia::render('Discografica/Cancion/Store',['rout'=>'/StoreCancion','routArtistas'=>'/Artistas','routAlmbunes'=>'/AlbumsArtista/', 'routGeneros'=>'/Generos']);
    }
    public function Store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'lyrics' => 'required|min:3|max:50',
            'duration_seconds' => 'required | integer',
            'album_id' => 'required | integer',
            'genero_id' => 'required | integer'
        ]);

        $cancion = new Cancion();
        $cancion->title = $request->title;
        $cancion->lyrics = $request->lyrics;
        $cancion->duration_seconds = $request->duration_seconds;
        $cancion->album_id = $request->album_id;
        $cancion->genero_id = $request->genero_id;
        $cancion->save();

        return redirect('/ShowCanciones');

    }
    public function Edit(Request $request)
    {
        $cancion = Cancion::find($request->id);

        return Inertia::render('Discografica/Cancion/Update',['object' => $cancion,'rout'=>'/UpdateCancion','routArtistas'=>'/Artistas','routAlmbunes'=>'/AlbumsArtista/', 'routGeneros'=>'/Generos']);
    }
    public function Update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'lyrics' => 'required|min:3|max:50',
            'duration_seconds' => 'required | integer',
            'album_id' => 'required | integer',
            'genero_id' => 'required | integer'
        ]);

        $cancion = Cancion::find($request->id);
        $cancion->title = $request->title;
        $cancion->lyrics = $request->lyrics;
        $cancion->duration_seconds = $request->duration_seconds;
        $cancion->album_id = $request->album_id;
        $cancion->genero_id = $request->genero_id;
        $cancion->save();

        return redirect('/ShowCanciones');
    }
    public function Destroy(Request $request)
    {
        $cancion = Cancion::find($request->id);
        $cancion->delete();
        return redirect('/ShowCanciones');
    }

}
