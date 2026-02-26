<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F9FAFB; }
        .brand-green { color: #1CC29F; }
        .bg-brand-green { background-color: #1CC29F; }
        .border-brand-green { border-color: #1CC29F; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen">

    <aside class="w-full md:w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm">
        <div class="p-6 flex items-center gap-2 text-2xl font-bold brand-green border-b border-gray-50">
            <i class="fas fa-home"></i>
            <span>Colocation</span>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-3 mb-2">Menu</p>

            <a href="#" class="flex items-center gap-3 p-3 bg-brand-green/10 text-emerald-700 rounded-lg font-semibold transition">
                <i class="fas fa-th-large w-5"></i> Vue d'ensemble
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-receipt w-5"></i> Dépenses
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-tasks w-5"></i> Tâches
            </a>

            @if(auth()->user()->role === 'admin')
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest ml-3 mb-2">Administration</p>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition font-bold">
                        <i class="fas fa-users w-5"></i> Utilisateurs
                    </a>
                </div>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-600 shadow-sm">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1">
        @yield('dashboard-content')
    </main>

</body>
</html>
