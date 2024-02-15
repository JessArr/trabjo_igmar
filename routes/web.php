<?php

use App\Http\Controllers\Discografica\AlbumController;
use App\Http\Controllers\Discografica\ArtistaController;
use App\Http\Controllers\Discografica\CancionController;
use App\Http\Controllers\Discografica\GeneroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersController;



Route::inertia('/about', 'About');

Route::get('users', [UsersController::class, 'index']);
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::get('users/create', [UsersController::class, 'create'])->name('users.create');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/ShowArtistas',[ArtistaController::class,'Show'])->name('artistas.show');
Route::get('/ShowAlbums',[AlbumController::class,'Show'])->name('albums.show');
Route::get('/ShowCanciones',[CancionController::class,'Show'])->name('canciones.show');
Route::get('/ShowGeneros',[GeneroController::class,'Show'])->name('generos.show');

Route::get('/CreateGenero',[GeneroController::class,'Create'])->name('generos.create');
Route::post('/StoreGenero',[GeneroController::class,'Store'])->name('generos.store');
Route::get('/EditGenero',[GeneroController::class,'Edit'])->name('generos.edit');
Route::put('/UpdateGenero',[GeneroController::class,'Update'])->name('generos.update');
Route::delete('/DestroyGenero/{id}',[GeneroController::class,'Destroy'])->name('generos.destroy');

Route::get('/Generos',[GeneroController::class,'Generos'])->name('get.Generos');

Route::get('/CreateArtista',[ArtistaController::class,'Create'])->name('artistas.create');
Route::post('/StoreArtista',[ArtistaController::class,'Store'])->name('artistas.store');
Route::get('/EditArtista',[ArtistaController::class,'Edit'])->name('artistas.edit');
Route::put('/UpdateArtista',[ArtistaController::class,'Update'])->name('artistas.update');
Route::delete('/DestroyArtista/{id}',[ArtistaController::class,'Destroy'])->name('artistas.destroy');


Route::get('/Artistas',[ArtistaController::class,'Artistas'])->name('get.Artistas');
Route::get('/AlbumsArtista/{id}',[ArtistaController::class,'AlbumsArtista'])->name('get.AlbumsArtista');

Route::get('/CreateAlbum',[AlbumController::class,'Create'])->name('albums.create');
Route::post('/StoreAlbum',[AlbumController::class,'Store'])->name('albums.store');
Route::get('/EditAlbum',[AlbumController::class,'Edit'])->name('albums.edit');
Route::put('/UpdateAlbum',[AlbumController::class,'Update'])->name('albums.update');
Route::delete('/DestroyAlbum/{id}',[AlbumController::class,'Destroy'])->name('albums.destroy');

Route::get('/CreateCancion',[CancionController::class,'Create'])->name('canciones.create');
Route::post('/StoreCancion',[CancionController::class,'Store'])->name('canciones.store');
Route::get('/EditCancion',[CancionController::class,'Edit'])->name('canciones.edit');
Route::put('/UpdateCancion',[CancionController::class,'Update'])->name('canciones.update');
Route::delete('/DestroyCancion/{id}',[CancionController::class,'Destroy'])->name('canciones.destroy');





require __DIR__.'/auth.php';
