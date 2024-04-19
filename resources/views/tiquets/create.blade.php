@extends('base')

@section('title', 'Créer un ticket')

@section('content')

<form class="container">
    @csrf
    <div class="grid grid-cols-3 grid-template mt-8">
        <div class="ml-24 mr-12 bg-white col-span-2 p-8 flex flex-col">
            <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg">
                <h1 class="text-end text-xl">Nouveau Ticket</h1>
                <input type="text" class="p-2 border border-black rounded-sm w-96 text-end" placeholder="Objet du Ticket">
                <textarea class="p-2 w-96 mt-2 border border-black rounded-sm text-end" rows="5" placeholder="Description"></textarea>
            </div>

            <button class="bg-yellow-400 w-24 p-2 mt-2 rounded-sm">Envoyer</button>
        </div>

        <div class="mr-12 bg-white p-8">
            <h1>Création de Ticket</h1>

            <label for="urgency">Urgence :</label>
            <select name="urgency" class="p-2 border border-black rounded-sm w-full mt-2">
                <option>Moyenne</option>
            </select>
            <label for="category">Categorie :</label>
            <select name="category" class="p-2 border border-black rounded-sm w-full mt-2">
                <option>Logiciel</option>
            </select>
        </div>
    </div>
</form>

@endsection