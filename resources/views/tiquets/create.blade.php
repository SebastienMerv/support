@extends('base')

@section('title', 'Créer un ticket')

@section('content')

<form class="container" method="POST" action="{{ route('tickets.store')}}">
    @csrf
    <div class="grid grid-cols-3 grid-template mt-8">
        <div class="ml-24 mr-12 bg-white col-span-2 p-8 flex flex-col">

            @if($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-sm mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg">
                <h1 class="text-end text-xl">Nouveau Ticket</h1>
                <input name="title" type="text" class="p-2 border border-black rounded-sm w-96 text-end" placeholder="Objet du Ticket">
                <textarea name="description" class="p-2 w-96 mt-2 border border-black rounded-sm text-end" rows="5" placeholder="Description"></textarea>
            </div>

            <button class="bg-yellow-400 w-24 p-2 mt-2 rounded-sm">Envoyer</button>
        </div>

        <div class="mr-12 bg-white p-8">
            <h1>Création de Ticket</h1>

            <label for="urgency">Urgence :</label>
            <select name="urgency" class="p-2 border border-black rounded-sm w-full mt-2">
                @foreach($priorities->sortBy('priority') as $priority)
                    <option value="{{ $priority->id}}" {{ $priority->level == 2 ? 'selected' : '' }}>{{ $priority->name }}</option>
                @endforeach
            </select>
            </select>
            <label for="category">Categorie :</label>
            <select name="category" class="p-2 border border-black rounded-sm w-full mt-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

@endsection