@extends('base')

@section('title', 'Categories')

@section('content')


    <div class="container">

        
        <div class="ml-24 mr-24 bg-white p-8 mt-2">
            <a href="{{ route('categories.create') }}" class="bg-green-500 text-white p-2 rounded-sm">Créer une catégorie</a>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 m-8 rounded-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500 m-8 text-white p-2 rounded-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="bg-red-500 m-8 text-white p-2 rounded-sm">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table-auto w-full">
                <thead>
                    <th>Nom</th>
                    <th>Action</th>
                </thead>

                <tbody class="h-full">
                    @foreach ($categories as $category)
                        <tr class="{{ !$loop->even ? 'bg-slate-200' : 'bg-white' }} rounded-sm">
                            <td class="p-4 text-center"> <!-- Ajoutez le padding ici -->
                                <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>

@endsection
