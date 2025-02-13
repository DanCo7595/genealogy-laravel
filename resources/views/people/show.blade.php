@extends('layouts.app')

@section('content')
    <h1>{{ $person->first_name }} {{ $person->last_name }}</h1>
    <p>Date de naissance : {{ $person->date_of_birth }}</p>

    <h3>Parents :</h3>
    <ul>
        @forelse ($person->parents as $parent)
            <li>{{ $parent->first_name }} {{ $parent->last_name }}</li>
        @empty
            <li>Aucun parent enregistré</li>
        @endforelse
    </ul>

    <h3>Enfants :</h3>
    <ul>
        @forelse ($person->children as $child)
            <li>{{ $child->first_name }} {{ $child->last_name }}</li>
        @empty
            <li>Aucun enfant enregistré</li>
        @endforelse
    </ul>

    <a href="{{ route('people.index') }}">Retour à la liste</a>
@endsection
