<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;

class PersonController extends Controller
{
    // Affiche la liste des personnes avec le nom de l'utilisateur qui les a créées
    public function index()
    {
        $people = Person::with('createdBy')->get();
        return view('people.index', compact('people'));
    }

    // Affiche une personne spécifique avec ses parents et ses enfants
    public function show($id)
    {
        $person = Person::with(['parents', 'children'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    // Affiche le formulaire de création d'une nouvelle personne
    public function create()
    {
        $users = User::all(); // Pour sélectionner l'utilisateur créateur
        return view('people.create', compact('users'));
    }

    // Insère une nouvelle personne après validation
    public function store(StorePersonRequest $request)
    {
        // Récupère les données validées
        $validatedData = $request->validated();

        // Ajouter l'utilisateur authentifié comme créateur
        $validatedData['created_by'] = auth()->id();

        // Créer une nouvelle personne avec les données validées
        Person::create($validatedData);

        // Rediriger l'utilisateur vers la liste des personnes ou vers une page de confirmation
        return redirect()->route('people.index')->with('success', 'Personne créée avec succès.');
    }
}
