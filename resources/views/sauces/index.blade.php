@extends('layouts.app')
{{-- On étend le layout principal qui contient la navigation et la meta CSRF --}}

@section('content')
<div class="container mt-4 text-center">
    <!-- Titre principal -->
    <h2 class="mb-4">THE SAUCES</h2>

    <!-- Message de succès éventuel (sauce ajoutée, supprimée, etc.) -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton pour ajouter une nouvelle sauce -->
    <a href="{{ route('sauces.create') }}" class="btn btn-primary mb-4">Add a new sauce</a>

    <!-- Vérification si on a des sauces -->
    @if($sauces->isEmpty())
        <p>Aucune sauce pour le moment.</p>
    @else
        <!-- Grille responsive avec 4 colonnes sur écran md, 2 colonnes sur sm, etc. -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach($sauces as $sauce)
                <div class="col">
                    <!-- Card sans bordure (border-0) pour un look plus épuré -->
                    <div class="card border-0">
                        <!-- Image de la sauce -->
                        <img src="{{ $sauce->imageUrl }}" alt="{{ $sauce->name }}"
                             class="card-img-top"
                             style="max-height: 200px; object-fit: contain;">
                             <!-- max-height pour éviter que l’image ne prenne trop de place
                                  object-fit: contain pour garder les proportions -->

                        <!-- Corps de la carte (nom, heat, etc.) -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $sauce->name }}</h5>
                            <p class="card-text mb-1">
                                Heat: {{ $sauce->heat }}/10
                            </p>
                            <p class="card-text text-muted mb-3">
                                {{ $sauce->manufacturer }}
                            </p>

                            <!-- Boutons d’action -->
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
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            @endforeach
        </div> <!-- /.row -->
    @endif
</div>
@endsection
