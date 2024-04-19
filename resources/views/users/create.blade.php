@extends('base')

@section('title', 'Créer un utilisateur')

@section('content')

<div class="bg-white ml-24 mr-24 mt-8 p-8">
    <div class="flex flex-row justify-between items-center mb-8">
        <h1 class="text-xl text-bold">Liste des utilisateurs</h1>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="flex flex-row mb-4">
            <div class="w-1/2 pr-4">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="w-1/2 pl-4">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
        </div>
        <div class="flex flex-row mb-4">
            <div class="w-1/2 pr-4">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="w-1/2 pl-4">
                <label for="role">Rôle</label>
                <select name="group_id" id="role" class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach($groups as $group)
                    <option value="{{ $group->id}}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <label for="check">Envoyer un lien d'initialisation du mot de passe</label><br>
        <input type="checkbox" id="check" name="link"><br>

        <button class="bg-yellow-400 p-2 rounded-sm">Enregistrer</button>
    </form>

</div>

@endsection