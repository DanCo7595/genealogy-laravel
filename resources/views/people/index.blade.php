@extends('layouts.app')

@section('content')
    <h1>Liste des Personnes</h1>
    <a href="{{ route('people.create') }}">Créer une nouvelle personne</a>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <ul>
        @foreach ($people as $person)
            <li>
                <a href="{{ route('people.show', $person->id) }}">
                    {{ $person->first_name }} {{ $person->last_name }}
                </a>
                - Créé par : {{ $person->createdBy->name ?? 'Inconnu' }}
            </li>
        @endforeach
    </ul>
@endsection
