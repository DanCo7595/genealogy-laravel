@extends('layouts.app')

@section('content')
    <h1>Créer une nouvelle personne</h1>
    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        <label for="created_by">Créé par :</label>
        <select name="created_by" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" required>
        <br>

        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" required>
        <br>

        <label for="birth_name">Nom de naissance :</label>
        <input type="text" name="birth_name">
        <br>

        <label for="middle_names">Autres prénoms :</label>
        <input type="text" name="middle_names">
        <br>

        <label for="date_of_birth">Date de naissance :</label>
        <input type="date" name="date_of_birth" required>
        <br>

        <button type="submit">Créer</button>
    </form>

    <a href="{{ route('people.index') }}">Retour à la liste</a>
@endsection
