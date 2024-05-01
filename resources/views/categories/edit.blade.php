@extends('base')

@section('title', 'Modifier une catégorie')

@section('content')

<div class="bg-white ml-24 mr-24 mt-8 p-8">
    <h1 class="text-2xl">Modifier la catégorie {{ $category->name }}</h1>

    <form action="{{ route('categories.update', $category->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name" id="name" class="border p-2 rounded-sm" value="{{ $category->name }}">

        <button type="submit" class="bg-yellow-400 text-white p-2 rounded-sm mt-2">Modifier la catégorie</button>
    </form>
</div>
@endsection