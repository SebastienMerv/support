@extends('base')

@section('title', 'Liste des utilisateurs')

@section('content')

<div class="bg-white ml-24 mr-24 mt-8 p-8">
    <div class="flex flex-row justify-between items-center mb-8">
        <h1 class="text-xl text-bold">Liste des utilisateurs</h1>
        <a href="{{ route('users.create')}}" class="bg-yellow-400 p-2 rounded-lg">Nouveau</a>
    </div>
    <table class="w-full">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->group->name }}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection