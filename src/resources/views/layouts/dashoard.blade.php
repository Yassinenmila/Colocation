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
    <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
        <i class="fas fa-chart-line w-5"></i> Dashboard
    </a>
    @if(auth()->role === 'admin')
        <div class="p-6 text-2xl font-bold brand-green flex items-center gap-2">
                <i class="fas fa-shield-alt"></i> <span>Admin</span>
        </div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="#" class="flex items-center gap-3 p-3 bg-brand-green/10 text-emerald-700 rounded-lg font-bold transition">
                <i class="fas fa-users w-5"></i> Utilisateurs
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-exclamation-triangle w-5"></i> Signalements
            </a>
        </nav>
    @endif
    <aside class="w-full md:w-64 bg-white border-r border-gray-200 flex flex-col">
        <div class="p-6 flex items-center gap-2 text-2xl font-bold brand-green border-b border-gray-50">
            <i class="fas fa-home"></i>
            <span>Colocation</span>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="flex items-center gap-3 p-3 bg-brand-green/10 text-emerald-700 rounded-lg font-semibold transition">
                <i class="fas fa-th-large"></i> Vue d'ensemble
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-receipt"></i> Dépenses
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-tasks"></i> Tâches ménagères
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-folder"></i> Documents
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-cog"></i> Paramètres
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-600">TM</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate">Thomas Martin</p>
                    <p class="text-[10px] text-gray-400">Admin du groupe</p>
                </div>
            </div>
        </div>
    </aside>
    @yield('dashboard-content')
    </body>
</html>
