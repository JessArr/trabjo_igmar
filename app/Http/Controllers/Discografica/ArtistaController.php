<?php

namespace App\Http\Controllers\Discografica;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artista;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtistaController extends Controller
{
    public function Show()
    {
        $artistas = Artista::all();
        return Inertia::render('Discografica/Artista/Index', [
            'objeto' => $artistas,
            'editarRoute' => '/EditArtista',
            'eliminarRoute' => '/DestroyArtista',
            'crearRoute' => '/CreateArtista'
        ]);
    }

    public function Create()
    {
        return Inertia::render('Discografica/Artista/Store', ['rout' => '/StoreArtista']);
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'stage_name' => 'required|min:3|max:50',
            'nationality' => 'required|min:3|max:50',
            'birthdate' => 'required',
            'biography' => 'required|min:3|max:50'
        ]);

        $artista = new Artista();
        $artista->name = $request->name;
        $artista->last_name = $request->last_name;
        $artista->stage_name = $request->stage_name;
        $artista->nationality = $request->nationality;
        $artista->birthdate = $request->birthdate;
        $artista->biography = $request->biography;
        $artista->save();

        return redirect('/ShowArtistas');
    }

    public function Edit(Request $request)
    {
        $artista = Artista::find($request->id);
        if (!$artista) {
            return redirect('/ShowArtistas  ');
        }

        return Inertia::render('Discografica/Artista/Update', ['objeto' => $artista, 'rout' => '/UpdateArtista']);
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'stage_name' => 'required|min:3|max:50',
            'nationality' => 'required|min:3|max:50',
            'birthdate' => 'required',
            'biography' => 'required|min:3|max:50'
        ]);

        $artista = Artista::find($request->id);
        if (!$artista) {
            return redirect('/ShowArtistas');
        }

        $artista->name = $request->name;
        $artista->last_name = $request->last_name;
        $artista->stage_name = $request->stage_name;
        $artista->nationality = $request->nationality;
        $artista->birthdate = $request->birthdate;
        $artista->biography = $request->biography;
        $artista->save();

        return redirect('/ShowArtistas');
    }

    public function Destroy($id)
    {
        $artista = Artista::find($id);
        if (!$artista) {
            return redirect('/ShowArtistas');
        }

        $artista->delete();
        return redirect('/ShowArtistas');
    }
    public function Artistas()
    {
        $artistas = Artista::all();
        return response()->json($artistas);
    }

    public function AlbumsArtista($id)
    {
        $albums = Album::where('artist_id', $id)->get();

        return response()->json($albums);
    }

}
