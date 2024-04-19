@extends('base')

@section('title', 'Créer un ticket')

@section('content')

<form class="container">
    @csrf
    <div class="grid grid-cols-3 grid-template mt-8">
        <!--- Faut rendre la div ici scrollable ---->
        <div class="ml-24 mr-12 bg-white col-span-2 p-8 flex flex-col mt-8 overflow-auto h-[500px]">
            <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg">
                <h1 class="text-end text-xl">Sébastien MERVEILLE</h1>
                <p class="text-start">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum nihil quo commodi harum earum voluptatum dignissimos eaque, expedita, esse doloremque consequatur! Illum, culpa itaque praesentium debitis aspernatur ex omnis aliquam?</p>
            </div>

            <div class="flex justify-center items-start flex-col bg-indigo-200 p-8 rounded-lg mt-8">
                <h1 class="text-start text-xl">VOUS</h1>
                <p class="text-end">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum nihil quo commodi harum earum voluptatum dignissimos eaque, expedita, esse doloremque consequatur! Illum, culpa itaque praesentium debitis aspernatur ex omnis aliquam?</p>
            </div>

            <div class="flex justify-center items-start flex-col bg-emerald-200 p-8 rounded-lg mt-8">
                <h1 class="text-start text-xl">JOHN DOE</h1>
                <p class="text-end">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum nihil quo commodi harum earum voluptatum dignissimos eaque, expedita, esse doloremque consequatur! Illum, culpa itaque praesentium debitis aspernatur ex omnis aliquam?</p>
            </div>

            <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg mt-8">
                <h1 class="text-end text-xl">Répondre</h1>
                <textarea class="p-2 w-96 mt-2 border border-black rounded-sm text-end" rows="5" placeholder="Description"></textarea>
            </div>

            <div>
                
                <button class="bg-yellow-400 w-24 p-2 mt-2 rounded-sm">Sauvegarder</button>
                <button class="bg-red-400 w-24 p-2 mt-2 rounded-sm">Fermer</button>
            </div>
        </div>

        <div class="mr-12 bg-white p-8">
            <h1 class="text-xl text-center">Problème avec les imprimantes</h1>

            <label for="urgency">Urgence :</label>
            <select name="urgency" class="p-2 border border-black rounded-sm w-full mt-2">
                <option>Moyenne</option>
            </select>
            <label for="category">Categorie :</label>
            <select name="category" class="p-2 border border-black rounded-sm w-full mt-2">
                <option>Logiciel</option>
            </select>

            <label for="assignation">Assignation :</label>
            <select name="assignation" multiple class="p-2 border border-black rounded-sm w-full mt-2">
                <option selected>Personne 1</option>
            </select>

            <!--- Observateur et demandeur ---->
            <label for="observer">Observateur :</label>
            <select name="observer" multiple class="p-2 border border-black rounded-sm w-full mt-2">
                <option selected>Personne 1</option>
            </select>

            <label for="requester">Demandeur :</label>
            <select name="requester" class="p-2 border border-black rounded-sm w-full mt-2">
                <option selected>Personne 1</option>
            </select>

            <a href="#" class="text-blue-400 underline">Historique</a>
        </div>
    </div>
</form>

@endsection