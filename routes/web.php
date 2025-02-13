<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Route pour lister les personnes
Route::get('/people', [PersonController::class, 'index'])->name('people.index');

// Route pour créer une personne - accessible uniquement aux utilisateurs authentifiés
Route::middleware('auth')->get('/people/create', [PersonController::class, 'create'])->name('people.create');

// Route pour enregistrer une personne - accessible uniquement aux utilisateurs authentifiés
Route::middleware('auth')->post('/people', [PersonController::class, 'store'])->name('people.store');

// Route pour afficher une personne
Route::get('/people/{id}', [PersonController::class, 'show'])->name('people.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
