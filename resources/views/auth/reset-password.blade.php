<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form class="w-screen bg-slate-100 h-screen flex items-center flex-col" method="POST" action="{{ route('password.reset', $token) }}">
        @csrf
        <img src="/assets/sebastienmerv.png" alt="Logo de Sébastien Merveille" class="w-32 mb-8 mt-8" title="{{ env('APP_NAME') }}">
        <div class="bg-white w-80 flex flex-col items-center p-12 w-[800px] h-[500px]">
            <h1 class="text-gray-800 text-2xl mb-6">Mot de passe oublié</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-96" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-96" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <input type="hidden" value="{{ $token}}" name="token">

            <div class="flex flex-col w-96 m-2">
                <label for="email">Adresse e-mail</label>
                <input id="email" name="email" type="email" placeholder="Votre adresse e-mail" class="p-2 border border-gray-400 rounded-lg h-12">
            </div>

            <div class="flex flex-col w-96 m-2">
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password" placeholder="Mot de passe" class="p-2 border border-gray-400 rounded-lg h-12">
            </div>

            <div class="flex flex-col w-96 m-2">
                <label for="password_confirmation">Confirmation du mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmez votre mot de passe" class="p-2 border border-gray-400 rounded-lg h-12">
            </div>

            <button type="submit" class="pt-2 pb-2 w-96 mt-4 rounded-lg bg-yellow-400 font-mono flex items-center justify-center font-semibold hover:bg-yellow-500">Modifier le mot de passe</button>
        </div>
    </form>
</body>
</html>
