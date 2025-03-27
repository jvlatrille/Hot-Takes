@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Ajouter une nouvelle Sauce</h2>
    <form action="{{ route('sauces.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="manufacturer" class="form-label">Fabriquant</label>
            <input type="text"
                   class="form-control"
                   id="manufacturer"
                   name="manufacturer"
                   value="{{ old('manufacturer') }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      rows="3"
                      required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Lien de l'image</label>
            <div class="d-flex align-items-center">
                <input type="text"
                       class="form-control me-3"
                       id="imageUrl"
                       name="imageUrl"
                       placeholder="http://..."
                       value="{{ old('imageUrl') }}">
                @if(old('imageUrl'))
                    <img src="{{ old('imageUrl') }}"
                         alt="Preview"
                         style="height: 60px; object-fit: contain;">
                @endif
            </div>
        </div>
        <div class="mb-3">
            <label for="mainPepper" class="form-label">Ingrédient principal</label>
            <input type="text"
                   class="form-control"
                   id="mainPepper"
                   name="mainPepper"
                   value="{{ old('mainPepper') }}"
                   required>
        </div>
        <div class="mb-3">
            <label for="heatRange" class="form-label">Heat</label>
            <div class="d-flex align-items-center">
                <input type="range"
                       class="form-range me-3"
                       min="1"
                       max="10"
                       id="heatRange"
                       name="heat"
                       value="{{ old('heat', 5) }}"
                       oninput="document.getElementById('heatValue').textContent = this.value">
                <span id="heatValue">{{ old('heat', 5) }}</span>
            </div>
        </div>
        <button type="submit" class="btn btn-success">SUBMIT</button>
        <a href="{{ route('sauces.index') }}" class="btn btn-secondary">CANCEL</a>
    </form>
</div>
@endsection
