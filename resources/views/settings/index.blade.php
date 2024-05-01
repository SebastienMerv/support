@extends('base')

@section('title', 'Paramètres')

@section('content')

    <form class="bg-white ml-24 mr-24 mt-8 p-8" method="POST" action="{{ route('settings.update') }}">
        @csrf
        @method('PUT')
        <h1 class="text-2xl">Paramètres de l'application</h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-4" role="alert">
                <p><strong>Erreur !</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach ($settings as $setting)
            <div class="mt-4">
                <label for="{{ $setting->name }}"
                    class="block text-sm font-medium text-gray-700">{{ $setting->display_name }}</label>
                <input name="{{ $setting->name }}" id="{{ $setting->name }}" value="{{ $setting->value }}"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                    @if ($setting->type == 'number') type="number" @endif>
            </div>
        @endforeach

        <button type="submit"
            class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Enregistrer
        </button>
    </form>

@endsection
