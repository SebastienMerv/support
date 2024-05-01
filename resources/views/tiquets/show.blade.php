@extends('base')

@section('title', 'Créer un ticket')

@section('content')

    <form class="container" method="POST" action="{{ route('tickets.update', $ticket->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-3 grid-template mt-8">
            <!--- Faut rendre la div ici scrollable ---->
            
            <div class="ml-24 mr-12 bg-white col-span-2 p-8 flex flex-col mt-8 overflow-auto h-[500px]">
                @if ($errors->any())
                <div class="bg-red-400 p-2 text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @foreach ($ticket->comments as $comment)
                    @if ($comment->user_id != auth()->id())
                        <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg mb-8">
                            <h1 class="text-end text-xl">{{ $comment->user->name }}</h1>
                            <p class="text-start">{{ $comment->comment }}</p>
                        </div>
                    @elseif($comment->user_id == auth()->id())
                        <div class="flex justify-center items-start flex-col bg-indigo-200 p-8 rounded-lg mb-8">
                            <h1 class="text-start text-xl">VOUS</h1>
                            <p class="text-end">{{ $comment->comment }}</p>
                        </div>
                    @else
                        <div class="flex justify-center items-start flex-col bg-emerald-200 p-8 rounded-lg mb-8">
                            <h1 class="text-start text-xl">{{ $comment->user->name }}</h1>
                            <p class="text-end">{{ $comment->comment }}</p>
                        </div>
                    @endif
                @endforeach

                <div class="flex justify-end items-end flex-col bg-slate-200 p-8 rounded-lg mt-8">
                    <h1 class="text-end text-xl">Répondre</h1>
                    <textarea name="description" class="p-2 w-96 mt-2 border border-black rounded-sm text-end" rows="5" placeholder="Description"></textarea>
                </div>

                <div>

                    <button class="bg-yellow-400 w-24 p-2 mt-2 rounded-sm">Sauvegarder</button>
                    @if (auth()->user()->group->name != 'Utilisateurs')
                        <button name="close" value="true" class="bg-red-400 w-24 p-2 mt-2 rounded-sm">Fermer</button>
                    @endif
                </div>
            </div>

            <div class="mr-12 bg-white p-8">
                <h1 class="text-xl text-center">Problème avec les imprimantes</h1>

                <label for="urgency">Urgence :</label>
                <select name="urgency" class="p-2 border border-black rounded-sm w-full mt-2">
                    @foreach ($priorities as $urgency)
                        <option value="{{ $urgency->id }}" @if ($urgency->id == $ticket->priority_id) selected @endif>{{ $urgency->name }}</option>
                    @endforeach
                </select>
                <label for="category">Categorie :</label>
                <select name="category" class="p-2 border border-black rounded-sm w-full mt-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $ticket->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="assignation">Assignation :</label>
                <select @if(auth()->user()->group->name != 'Admininistrateurs') disabled @endif name="assignation[]" multiple class="p-2 border border-black rounded-sm w-full mt-2">
                    @foreach ($users as $user)
                        @if ($user->isTechnician())
                            @if ($ticket->technicians->contains($user))
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>

                <!--- Observateur et demandeur ---->
                <label for="observer">Observateur :</label>
                <select @if(auth()->user()->group->name != 'Admininistrateurs') disabled @endif name="observer[]" multiple class="p-2 border border-black rounded-sm w-full mt-2">
                    @foreach ($users as $user)
                        @if ($user->isTechnician())
                            @if ($ticket->technicians->contains($user))
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>

                <label for="requester">Demandeur :</label>
                <select disabled name="requester" class="p-2 border border-black rounded-sm w-full mt-2">
                    <option selected>{{ $ticket->user->name }}</option>
                </select>

                <a href="#" class="text-blue-400 underline">Historique</a>
            </div>
        </div>
    </form>

@endsection
