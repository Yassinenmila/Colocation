<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colocation | Gérez votre foyer sans stress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brand-green { color: #1CC29F; }
        .bg-brand-green { background-color: #1CC29F; }
        .bg-brand-green:hover { background-color: #16a385; }
    </style>
</head>
<body class="bg-white text-gray-800">

    <nav class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-2 text-2xl font-bold brand-green">
            <i class="fas fa-home"></i>
            <span>Colocation</span>
        </div>
        <div class="flex items-center gap-3">

    @auth
        <!-- Mon espace -->
        <a href="{{ route('home') }}"
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow hover:bg-gray-200 transition font-medium">
           Mon espace
        </a>

        <!-- Admin -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow hover:bg-gray-200 transition font-medium">
               Admin
            </a>
        @endif

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition font-medium">
                Déconnexion
            </button>
        </form>
    @endauth

    @guest
        <!-- Connexion -->
        <a href="{{ route('login') }}"
           class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition font-medium">
           Connexion
        </a>

        <!-- S'inscrire -->
        <a href="{{ route('signup') }}"
           class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition font-medium">
           S'inscrire
        </a>
    @endguest
</div>
    </nav>

    <main>
        @yield('content')
    </main>
   <footer class="border-t border-gray-100 py-12 px-6">
        <div class="max-w-7xl mx-auto flex md:flex-row justify-center items-center text-sm text-gray-400 italic">
            <p>© 2026 Colocation. Inspiré par la simplicité.</p>
        </div>
    </footer>

</body>
</html>
