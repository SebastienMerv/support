@extends('base')

@section('title', 'Détails de la catégorie')

@section('content')

<div class="bg-white ml-24 mr-24 mt-8 p-8">
    <h1 class="text-2xl">Détails de la catégorie {{ $category->name }}</h1>

    <p class="mb-8">Nombre de tickets associés à cette catégorie: {{ $category->tickets->count() }}</p>

    <a href="{{ route('categories.edit', $category->id)}}" class="bg-yellow-400 text-white p-2 rounded-sm mt-2">Modifier la catégorie</a>
    <form action="{{ route('categories.destroy', $category->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-400 text-white p-2 rounded-sm mt-2">Supprimer la catégorie</button>
    </form>
</div>
@endsection