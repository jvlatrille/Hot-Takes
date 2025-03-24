@extends('layouts.app')
{{-- On étend le layout principal pour bénéficier de la navigation et du token CSRF --}}

@section('content')
<div class="container mt-4">
    <h1>{{ $sauce->name }}</h1>
    <p><strong>Créateur :</strong>
        @if($sauce->user)
            {{ $sauce->user->email }}
        @else
            Inconnu
        @endif
    </p>
    <p><strong>Fabricant :</strong> {{ $sauce->manufacturer }}</p>
    <p><strong>Description :</strong> {{ $sauce->description }}</p>
    <p><strong>Ingrédient principal :</strong> {{ $sauce->mainPepper }}</p>
    <p><strong>Force (1-10) :</strong> {{ $sauce->heat }}</p>
    <p><strong>Image :</strong><br>
       <img src="{{ $sauce->imageUrl }}" alt="Image de la sauce {{ $sauce->name }}" style="max-width:200px;">
    </p>
    <p>
        <strong>Likes :</strong> {{ $sauce->likes }} &nbsp;
        <strong>Dislikes :</strong> {{ $sauce->dislikes }}
    </p>

    {{-- Boutons pour liker/disliker --}}
    <div class="mb-3">
        <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="like" value="1">
            <button type="submit" class="btn btn-outline-success">👍 J'aime</button>
        </form>
        <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="like" value="-1">
            <button type="submit" class="btn btn-outline-danger">👎 Je n'aime pas</button>
        </form>
        <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="like" value="0">
            <button type="submit" class="btn btn-secondary">Annuler mon vote</button>
        </form>
    </div>

    {{-- Liens pour éditer ou supprimer la sauce --}}
    <a href="{{ route('sauces.index') }}" class="btn btn-light">← Retour à la liste</a>
    <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-warning">Éditer</a>
    <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette sauce ?')">Supprimer</button>
    </form>
</div>
@endsection
