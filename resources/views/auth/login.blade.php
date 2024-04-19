<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form class="w-screen bg-slate-100 h-screen flex items-center flex-col" method="POST" action="{{ route('doLogin')}}">
        @csrf
        <img src="/assets/sebastienmerv.png" alt="Logo de Sébastien Merveille" class="w-32 mb-8 mt-8" title="{{ env('APP_NAME') }}">
        <div class="bg-white w-80 flex flex-col items-center p-12 w-[800px] h-[400px]">
            <h1 class="text-gray-800 text-2xl mb-6">Connexion à votre compte</h1>

            <div class="flex flex-col w-96 m-8">
                <label for="email">Adresse email</label>
                <input id="email" name="email" type="text" placeholder="Votre adresse email de connexion" class="p-2 border border-gray-400 rounded-lg h-12">
            </div>

            <div class="flex flex-col w-96">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" placeholder="Votre mot de passe"class="p-2 border border-gray-400 rounded-lg h-12">
            </div>

            <button class="pt-2 pb-2 w-96 mt-4 rounded-lg bg-yellow-400 font-mono flex items-center justify-center font-semibold hover:bg-yellow-500">Se connecter</button>
        </div>
    </form>
</body>
</html>