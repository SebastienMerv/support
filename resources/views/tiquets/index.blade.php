@extends('base')

@section('title', 'Tickets')

@section('content')

{{-- TODO : Filter on attribued --}}
{{-- <div class="mt-8 bg-white ml-24 mr-24 p-2">
    <select name="" id="" class="border p-2 rounded-sm">
        <option value="">Me sont attribués</option>
        <option value="">Tous</option>
        <option value="">Non-attribués</option>
    </select>
    <select name="" id="" class="border p-2 rounded-sm">
        <option value="">Tous</option>
        <option value="">En cours</option>
        <option value="">En attente</option>
    </select>

    <button class="p-2 bg-yellow-400 rounded-sm"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
</div> --}}

<form class="mt-2 bg-white ml-24 mr-24 p-2">
    <select name="contains" id="" class="border p-2 rounded-sm">
        <option value="yes" @if(request()->contains == 'yes') selected @endif>Contient</option>
        <option value="no" @if(request()->contains == 'no') selected @endif>Ne contient pas</option> 
    </select>
    <input type="text" name="search" class="border p-2 rounded-sm" @if(request()->search) value="{{ request()->search }}" @endif>

    <button class="p-2 bg-yellow-400 rounded-sm"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
</form>

<div class="container">
    <div class="ml-24 mr-24 bg-white p-8 mt-2">
    
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded-sm mb-2">
                {{ session('error') }}
            </div>
        @endif

        <table class="table-auto w-full">
            <thead>
                <th>Prioritée</th> <!-- Changement d'ordre ici -->
                <th>Titre</th>
                <th>Demandeur</th>
            </thead>

            <tbody class="h-full">
                @foreach($tickets as $ticket)
                <tr class="{{ !$loop->even ? 'bg-slate-200' : 'bg-white' }} rounded-sm">
                    <td class="p-2"> <!-- Ajoutez le padding ici -->
                        <div class="flex items-center justify-center">
                            <span class="bg-{{ $ticket->priority->color}}-300 p-2 rounded-full h-8 w-8 block"></span> <!-- Ajout de la classe 'block' pour centrer verticalement -->
                        </div>
                    </td>
                    <td class="p-4 text-center"> <!-- Ajoutez le padding ici -->
                        <a href="{{ route('tickets.show', $ticket->id )}}">{{ $ticket->title }}</a>
                    </td>
                    <td class="p-4 text-center"> <!-- Ajoutez le padding ici -->
                        {{ $ticket->user->name }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection