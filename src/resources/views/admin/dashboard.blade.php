@extends('layouts.dashboard')
@section('dashboard-content')

    <main class="flex-1 p-6 md:p-10">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Salut Thomas 👋</h1>
                <p class="text-gray-500">Voici ce qu'il se passe dans l'appart' cette semaine.</p>
            </div>
            <button class="bg-brand-green text-white px-6 py-2.5 rounded-lg font-bold shadow-sm flex items-center gap-2 self-start md:self-center">
                <i class="fas fa-plus"></i> Ajouter une dépense
            </button>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-400 text-sm font-medium uppercase mb-2">Total Dépenses (Mois)</p>
                <p class="text-3xl font-extrabold text-gray-900">1 240,50 €</p>
                <p class="text-xs text-emerald-500 mt-2 font-bold leading-none italic">+12% vs mois dernier</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-400 text-sm font-medium uppercase mb-2">Solde actuel</p>
                <p class="text-3xl font-extrabold brand-green">+ 45,20 €</p>
                <p class="text-xs text-gray-400 mt-2 italic font-medium leading-none">Tu es dans le vert !</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-400 text-sm font-medium uppercase mb-2">Tâches en attente</p>
                <p class="text-3xl font-extrabold text-orange-500">3</p>
                <p class="text-xs text-gray-400 mt-2 font-medium italic leading-none">Prochaine : Poubelles demain</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h2 class="font-bold text-gray-800">Dernières dépenses</h2>
                    <a href="#" class="text-xs brand-green font-bold uppercase tracking-wider">Voir tout</a>
                </div>
                <div class="divide-y divide-gray-50">
                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Courses hebdomadaires</p>
                                <p class="text-[11px] text-gray-400 italic">Payé par Antoine • Hier</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold">84,20 €</p>
                            <p class="text-[10px] text-orange-500 font-medium italic">Tu dois 28,06 €</p>
                        </div>
                    </div>
                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Facture Électricité</p>
                                <p class="text-[11px] text-gray-400 italic">Payé par Toi • Il y a 3 jours</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold">120,00 €</p>
                            <p class="text-[10px] brand-green font-medium italic">On te doit 80,00 €</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h2 class="font-bold text-gray-800 mb-6">Membres du foyer</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs italic">A</div>
                                <span class="text-sm font-medium text-gray-600">Antoine</span>
                            </div>
                            <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded italic font-medium">À jour</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs italic">S</div>
                                <span class="text-sm font-medium text-gray-600">Sarah</span>
                            </div>
                            <span class="text-xs bg-orange-50 text-orange-500 px-2 py-1 rounded italic font-medium">Doit 12,40 €</span>
                        </div>
                    </div>
                </div>

                <div class="bg-brand-green p-6 rounded-2xl shadow-lg text-white">
                    <h2 class="font-bold mb-4">Prochaine corvée</h2>
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 p-3 rounded-lg">
                            <i class="fas fa-trash-alt text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-bold italic">Sortir les poubelles (Jaune)</p>
                            <p class="text-sm opacity-80">Demain avant 08h00</p>
                            <button class="mt-4 bg-white text-emerald-600 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-tight">C'est fait !</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
