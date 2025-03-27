@extends('layouts.app')

@section('content')
<div class="container mt-4 text-center">
    <h2 class="mb-4">NOS SAUCES</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('sauces.create') }}" class="btn btn-primary mb-4">Ajouter une nouvelle sauce</a>

    @if($sauces->isEmpty())
    <p>Aucune sauce pour le moment.</p>
    @else
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach($sauces as $sauce)
        <div class="col">
            <div class="card border-0">
                <img src="{{ $sauce->imageUrl }}" alt="{{ $sauce->name }}"
                    class="card-img-top"
                    style="max-height: 200px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title">{{ $sauce->name }}</h5>
                    <p class="card-text mb-1">
                        Heat: {{ $sauce->heat }}/10
                    </p>
                    <p class="card-text text-muted mb-3">
                        {{ $sauce->manufacturer }}
                    </p>
                    @auth
                    <div>
                        <a href="{{ route('sauces.show', $sauce->id) }}" class="btn btn-info me-1">
                            Voir
                        </a>
                        <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-warning me-1">
                            Éditer
                        </a>
                        <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger"
                                onclick="return confirm('Supprimer cette sauce ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection