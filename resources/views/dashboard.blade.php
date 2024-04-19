@extends('base')

@section('title', 'Tableau de bord')

@section('content')

<div class="container">
    <div class="ml-24 mt-12 bg-white mr-24 p-12 rounded-sm">
        <div class="grid grid-cols-2">
    <div class="bg-blue-100 w-96 p-8">
        <h1 class="text-3xl text-blue-500">
            0
        </h1>
        <p class="text-2xl text-blue-500">Tickets ouverts</p>
    </div>
    <div class="bg-red-100 w-96 p-8">
        <h1 class="text-3xl text-red-500">
            0
        </h1>
        <p class="text-2xl text-red-500">Tickets en attente</p>
    </div>
    </div>
    </div>
</div>

@endsection