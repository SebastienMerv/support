@extends('base')

@section('title', 'Confirmation de suppression')

@section('content')

<div class="bg-white ml-24 mr-24 mt-8 p-8">
    <h1 class="text-2xl">Êtes-vous sûr de vouloir supprimer la catégorie {{ $category->name }} ?</h1>

    <form action="{{ route('categories.destroy', $category->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <label for="select">Redirger tous les tickets de la catégories vers la suivante :</label>
        <select name="confirm" id="select" class="border p-2 rounded-sm">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-red-500 text-white p-2 rounded-sm mt-2">Confirmer la suppression</button>
    </form>
</div>

@endsection