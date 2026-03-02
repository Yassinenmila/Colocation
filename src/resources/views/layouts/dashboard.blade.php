<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F9FAFB; }
        .brand-green { color: #1CC29F; }
        .bg-brand-green { background-color: #1CC29F; }
        .border-brand-green { border-color: #1CC29F; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen">

    <aside class="w-full md:w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm z-50">
        <div class="p-6 flex items-center justify-between border-b border-gray-50">
            <div class="flex items-center gap-2 text-2xl font-black brand-green italic">
                <i class="fas fa-home"></i>
                <a href="{{ route('home') }}"><span>Coloc.</span></a>
            </div>

            </div>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-3 mb-2">Menu principal</p>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 bg-brand-green/10 text-emerald-700 rounded-2xl font-bold transition">
                <i class="fas fa-th-large w-5"></i> Vue d'ensemble
            </a>
            <a href="{{ auth()->user()->membreships ? route('colocations.show', auth()->user()->membreships->colocation_id) : route('colocations.create') }}"
               class="flex items-center gap-3 p-3 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-2xl transition font-semibold">
                <i class="fas fa-home w-5"></i> Ma colocation
            </a>
            @if(auth()->user()->membreship && auth()->user()->membreship->role === 'owner')
                <a href="{{ route('categories.index', auth()->user()->membreship->colocation_id) }}" class="flex items-center gap-3 p-3 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-2xl transition font-semibold">
                    <i class="fas fa-crown w-5"></i> Gérer les categories
                </a>
            @endif

            @if(auth()->user()->role === 'admin')
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest ml-3 mb-2">Administration</p>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-red-50 hover:text-red-600 rounded-2xl transition font-bold">
                        <i class="fas fa-users w-5"></i> Utilisateurs
                    </a>
                </div>
            @endif

        </nav>

        <div class="p-4 border-t border-gray-50">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-[1.5rem] border border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center font-black text-white shadow-lg italic">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-black text-gray-900 truncate tracking-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto bg-[#F9FAFB]">
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center gap-2">
                <i class="fas fa-check-circle text-emerald-500"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i> {{ session('error') }}
            </div>
        @endif
        @yield('dashboard-content')
    </main>

</body>
</html>
