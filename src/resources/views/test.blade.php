<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Comptes | Colocation Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F9FAFB; }
        .brand-green { color: #1CC29F; }
        .bg-brand-green { background-color: #1CC29F; }
        .status-banned { background-color: #FEE2E2; color: #DC2626; }
        .status-active { background-color: #DCFCE7; color: #166534; }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
        <div class="p-6 text-2xl font-bold brand-green flex items-center gap-2">
            <i class="fas fa-shield-alt"></i> <span>Admin</span>
        </div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-chart-line w-5"></i> Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 p-3 bg-brand-green/10 text-emerald-700 rounded-lg font-bold transition">
                <i class="fas fa-users w-5"></i> Utilisateurs
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-exclamation-triangle w-5"></i> Signalements
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-6 md:p-10">

        <div class="max-w-6xl mx-auto">
            <header class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Comptes Utilisateurs</h1>
                    <p class="text-gray-500 font-medium">Gérez les accès et la modération de la plateforme.</p>
                </div>
                <div class="flex gap-3">
                    <span class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-bold shadow-sm">
                        Total : 1,284
                    </span>
                </div>
            </header>

            <div class="flex gap-4 mb-6">
                <button class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-bold shadow-md transition">Tous</button>
                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-full text-sm font-bold hover:bg-gray-50 transition">Actifs</button>
                <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-full text-sm font-bold hover:bg-gray-50 transition">Bannis</button>
            </div>

            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-widest">
                            <th class="px-6 py-4 font-bold">Utilisateur</th>
                            <th class="px-6 py-4 font-bold">État</th>
                            <th class="px-6 py-4 font-bold">Date d'inscription</th>
                            <th class="px-6 py-4 font-bold">Colocation</th>
                            <th class="px-6 py-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">

                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Marc+D&background=1CC29F&color=fff" class="w-9 h-9 rounded-full shadow-sm">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Marc Dupont</p>
                                        <p class="text-xs text-gray-400">marc.d@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <span class="px-3 py-1 rounded-full font-bold status-active">Actif</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">12 Jan 2026</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-bold">Appart' Lyon 3</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-red-600 transition p-2" title="Bannir">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="bg-red-50/30 hover:bg-red-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3 opacity-70">
                                    <img src="https://ui-avatars.com/api/?name=Kevin+S&background=333&color=fff" class="w-9 h-9 rounded-full grayscale shadow-sm">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Kevin Sansgêne</p>
                                        <p class="text-xs text-gray-400">kevin.bad@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <span class="px-3 py-1 rounded-full font-bold status-banned uppercase tracking-tighter">Banni</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">05 Fév 2026</td>
                            <td class="px-6 py-4 text-sm text-gray-400 italic font-medium">— Aucun —</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-emerald-500 hover:text-emerald-700 transition font-bold text-xs uppercase" title="Réactiver">
                                    Réactiver
                                </button>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Léa+M&background=F3E5F5&color=9C27B0" class="w-9 h-9 rounded-full shadow-sm">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Léa Morel</p>
                                        <p class="text-xs text-gray-400">lea.m@email.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <span class="px-3 py-1 rounded-full font-bold status-active">Actif</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">20 Fév 2026</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-bold">Coloc Bordeaux</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-red-600 transition p-2" title="Bannir">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="mt-8 bg-gray-900 text-white p-6 rounded-3xl flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center gap-4 mb-4 md:mb-0">
                    <div class="bg-red-500 w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-red-500/20">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg leading-tight">Zone de Sécurité</p>
                        <p class="text-gray-400 text-sm italic">Les bannissements suppriment l'accès immédiat à l'application.</p>
                    </div>
                </div>
                <button class="bg-white text-gray-900 px-6 py-2.5 rounded-full font-black text-sm hover:bg-gray-100 transition shadow-xl">
                    Voir les rapports récents
                </button>
            </div>
        </div>
    </main>

</body>
</html>
