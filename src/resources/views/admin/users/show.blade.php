@extends('layouts.dashboard')

@section('dashboard-content')
<div class="max-w-5xl mx-auto p-6 md:p-10">

    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-900 transition text-sm font-bold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="p-8 flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background={{ $user->is_banned ? '333' : '1CC29F' }}&color=fff&size=128"
                     class="w-32 h-32 rounded-3xl shadow-lg {{ $user->is_banned ? 'grayscale' : '' }}">
                @if($user->is_banned)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-md uppercase">Banni</span>
                @else
                    <span class="absolute -bottom-2 -right-2 bg-emerald-500 w-6 h-6 border-4 border-white rounded-full"></span>
                @endif
            </div>

            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $user->name }}</h1>
                    <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold uppercase tracking-widest italic">
                        ID: #{{ $user->id }}
                    </span>
                </div>
                <p class="text-gray-500 font-medium mb-6">Membre depuis le {{ $user->created_at->format('d F Y') }}</p>

                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    <div class="bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 text-sm">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Email</span>
                        <span class="font-bold text-gray-700">{{ $user->email }}</span>
                    </div>
                    <div class="bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 text-sm">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Colocation</span>
                        <span class="font-bold brand-green">{{ $user->colocation->name ?? 'Aucune' }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2 w-full md:w-auto">
                @if($user->is_banned)
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full border border-emerald-500 text-emerald-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-50 transition">
                            <i class="fas fa-undo mr-2"></i> Réactiver
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full border border-red-200 text-red-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-50 transition">
                            <i class="fas fa-ban mr-2"></i> Bannir
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm md:col-span-2">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-6 italic">Activité financière</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                    <p class="text-[10px] font-bold text-emerald-600 uppercase">Dépenses totales créées</p>
                    <p class="text-2xl font-black text-emerald-700">1 420,00 €</p>
                </div>
                <div class="p-4 bg-orange-50 rounded-2xl border border-orange-100">
                    <p class="text-[10px] font-bold text-orange-600 uppercase">Solde actuel</p>
                    <p class="text-2xl font-black text-orange-700">- 45,50 €</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-6 italic">Sécurité</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Dernière connexion</p>
                    <p class="text-sm font-bold text-gray-700 italic">Il y a 2 heures</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Adresse IP</p>
                    <p class="text-sm font-bold text-gray-700 italic">192.168.1.102</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Vérification Email</p>
                    <span class="text-[10px] font-bold px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">Vérifié ✅</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h2 class="text-sm font-bold text-gray-800 italic">Journal d'activité récent</h2>
            <i class="fas fa-history text-gray-300"></i>
        </div>
        <div class="divide-y divide-gray-50">
            <div class="p-4 flex justify-between items-center">
                <p class="text-xs font-medium text-gray-600 italic">A créé la dépense <span class="font-bold text-gray-900">"Courses Intermarché"</span></p>
                <span class="text-[10px] text-gray-400">14:02</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <p class="text-xs font-medium text-gray-600 italic">A rejoint la colocation <span class="font-bold text-gray-900">"Appart' Lyon 3"</span></p>
                <span class="text-[10px] text-gray-400">Hier</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <p class="text-xs font-medium text-gray-600 italic">A modifié son mot de passe</p>
                <span class="text-[10px] text-gray-400">02 Fév 2026</span>
            </div>
        </div>
    </div>

</div>
@endsection
