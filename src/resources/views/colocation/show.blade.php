@extends('layouts.dashboard')

@section('dashboard-content')
<div class="max-w-6xl mx-auto p-6 md:p-10">

    <div class="mb-8 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-900 transition text-sm font-bold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Retour au tableau de bord
        </a>
        @if(auth()->user()->membreships?->role === 'owner')
            <a href="{{ route('colocations.create') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-sm flex items-center gap-2">
                <i class="fas fa-plus"></i> Nouvelle colocation
            </a>
        @endif
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="p-8 md:p-12">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-2xl brand-green">
                        <i class="fas fa-home"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $colocation->name }}</h1>
                        <p class="text-gray-500 font-medium mt-1">{{ $colocation->membreships->count() }} membre(s)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Dépenses</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->depenses->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">dépenses enregistrées</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Catégories</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->categories->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">catégories configurées</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Invitations</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->invitations->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">en attente</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h2 class="text-sm font-bold text-gray-800 italic">Membres de la colocation</h2>
            <i class="fas fa-users text-gray-300"></i>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($colocation->membreships as $membreship)
                <div class="p-4 flex justify-between items-center hover:bg-gray-50/50 transition">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($membreship->user->name) }}&background=1CC29F&color=fff"
                             class="w-10 h-10 rounded-full shadow-sm">
                        <div>
                            <p class="font-bold text-gray-900">{{ $membreship->user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $membreship->user->email }}</p>
                        </div>
                        <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase
                            {{ $membreship->role === 'owner' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $membreship->role }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $membreship->joined_at->format('d M Y') }}</span>
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 italic">
                    Aucun membre pour le moment.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
