@extends('base')

@section('title', 'Categories')

@section('content')
<div class="bg-white m-8 p-8 rounded-sm">
    <h1 class="text-3xl font-bold mb-4">Création d'une catégorie</h1>
    <form action="{{ route('categories.store') }}" method="POST" class="max-w-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nom de la catégorie</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <button type="submit" class="bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Créer la catégorie</button>
    </form>
</div>
@endsection
