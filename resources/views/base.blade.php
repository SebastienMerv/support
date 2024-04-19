<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME')}} - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/e0ff61255d.js" crossorigin="anonymous"></script>
</head>
<body class="flex flex-row bg-slate-100">
    <nav class="pl-2 text-white bg-slate-800 w-80 h-screen flex pt-12 flex-col">
        <p class="text-yellow-400 text-3xl"><i class="fa-solid fa-headset"></i> Assistance</p>
        <ul class="ml-8 text-xl">
            <li><a href="{{ route('dashboard')}}"><i class="fa-solid fa-gauge"></i> Tableau de bord</a></li>
            <li><a href="{{ route('tickets.index')}}"><i class="fa-solid fa-info"></i> Tickets</a></li>
        </ul>

        <p class="text-yellow-400 text-3xl"><i class="fa-solid fa-user-tie"></i> Administration</p>
        <ul class="ml-8 text-xl">
            <li><a href="{{ route('users.index')}}"><i class="fa-solid fa-user"></i> Utilisateurs</a></li>
        </ul>
    </nav>
    
    <main class="flex flex-col w-full">
    <nav class="w-full h-12 flex flex-row items-center bg-white border pl-8">
        <ul>
            <li class="border p-2 rounded-sm"><i class="fa-solid fa-house"></i> Accueil</li>
        </ul>
    </nav>

    <div class="main">
        @yield('content')
    </div>

    </main>
</body>
</html>