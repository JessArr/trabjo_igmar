<?php

namespace App\Http\Controllers\Discografica;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneroController extends Controller
{
    public function Show()
    {
        $genero = Genero::all();
        return Inertia::render('Discografica/Genero/Index',['objeto' => $genero,'editarRoute'=>'/EditGenero', 'eliminarRoute'=>'/DestroyGenero','crearRoute'=>'/CreateGenero']);
    }
    public function Create()
    {
        return Inertia::render('Discografica/Genero/Store',['rout' => '/StoreGenero']);
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | max:50',
            'description' => 'required | min:3 | max:50'
        ]);

        $genero = new Genero();
        $genero->name = $request->name;
        $genero->description = $request->description;
        $genero->save();
        return redirect('/ShowGeneros');
    }


    public function Edit(Request $request)
    {
        $genero = Genero::find($request->id);
        return Inertia::render('Discografica/Genero/Update',['objeto' => $genero ,'rout' => '/UpdateGenero']);
    }
    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | max:50',
            'description' => 'required | min:3 | max:50'
        ]);

        $genero = Genero::find($request->id);
        $genero->name = $request->name;
        $genero->description = $request->description;
        $genero->save();
        return redirect('/ShowGeneros');
    }
    public function Destroy($id)
    {
        $genero = Genero::find($id);
        $genero->delete();
        return redirect('/ShowGeneros');
    }
    public function Generos()
    {
        $genero = Genero::all();
        return response()->json($genero);
    }
}
