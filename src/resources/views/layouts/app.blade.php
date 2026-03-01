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
            <div class="relative group">
                <button class="relative p-2 text-gray-400 hover:text-emerald-500 transition">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                <div class="absolute left-0 mt-2 w-72 bg-white rounded-3xl shadow-2xl border border-gray-100 p-5 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-300 z-[100]">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Invitations (1)</p>

                    <div class="flex gap-3 items-start">
                        <img src="https://ui-avatars.com/api/?name=Thomas&background=1CC29F&color=fff" class="w-10 h-10 rounded-xl shadow-sm">
                        <div class="flex-1">
                            <p class="text-[11px] leading-tight text-gray-600">
                                <span class="font-bold text-gray-900">Thomas</span> t'invite dans <br>
                                <span class="font-black brand-green italic uppercase">Appart' Marrakech</span>
                            </p>
                            <div class="flex gap-2 mt-3">
                                <button class="bg-brand-green text-white px-3 py-1.5 rounded-lg text-[9px] font-black uppercase shadow-md shadow-emerald-50">Accepter</button>
                                <button class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase hover:bg-red-50 hover:text-red-500 transition">Refuser</button>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- Mon espace -->
        <a href="{{ route('colocations.index') }}"
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow hover:bg-gray-200 transition font-medium">
           Mon espace
        </a>

        <!-- Admin -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('dashboard') }}"
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
