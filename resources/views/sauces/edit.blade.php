@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Sauce "{{ $sauce->name }}"</h2>
    <form action="{{ route('sauces.update', $sauce->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ old('name', $sauce->name) }}"
                   required>
        </div>

        {{-- Manufacturer --}}
        <div class="mb-3">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text"
                   class="form-control"
                   id="manufacturer"
                   name="manufacturer"
                   value="{{ old('manufacturer', $sauce->manufacturer) }}"
                   required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      rows="3"
                      required>{{ old('description', $sauce->description) }}</textarea>
        </div>

        {{-- "ADD IMAGE" + imageUrl + aperçu --}}
        <div class="mb-3">
            <label class="form-label d-block">ADD IMAGE</label>
            <div class="d-flex align-items-center">
                <input type="text"
                       class="form-control me-3"
                       id="imageUrl"
                       name="imageUrl"
                       placeholder="http://..."
                       value="{{ old('imageUrl', $sauce->imageUrl) }}">
                @if(old('imageUrl', $sauce->imageUrl))
                    <img src="{{ old('imageUrl', $sauce->imageUrl) }}"
                         alt="Preview"
                         style="height: 60px; object-fit: contain;">
                @endif
            </div>
        </div>

        {{-- Main Pepper Ingredient --}}
        <div class="mb-3">
            <label for="mainPepper" class="form-label">Main Pepper Ingredient</label>
            <input type="text"
                   class="form-control"
                   id="mainPepper"
                   name="mainPepper"
                   value="{{ old('mainPepper', $sauce->mainPepper) }}"
                   required>
        </div>

        {{-- Heat (slider) --}}
        <div class="mb-3">
            <label for="heatRange" class="form-label">Heat</label>
            <div class="d-flex align-items-center">
                <input type="range"
                       class="form-range me-3"
                       min="1"
                       max="10"
                       id="heatRange"
                       name="heat"
                       value="{{ old('heat', $sauce->heat) }}"
                       oninput="document.getElementById('heatValue').textContent = this.value">
                <span id="heatValue">{{ old('heat', $sauce->heat) }}</span>
            </div>
        </div>

        {{-- Boutons --}}
        <button type="submit" class="btn btn-primary">SAVE</button>
        <a href="{{ route('sauces.show', $sauce->id) }}" class="btn btn-secondary">CANCEL</a>
    </form>
</div>
@endsection
