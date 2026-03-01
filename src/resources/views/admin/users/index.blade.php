@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="max-w-6xl mx-auto p-6 md:p-10">
        <header class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Comptes Utilisateurs</h1>
                <p class="text-gray-500 font-medium">Gérez les accès et la modération de la plateforme.</p>
            </div>
            <div class="flex gap-3">
                <span class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-bold shadow-sm">
                    Total : {{ $users->count() }}
                </span>
            </div>
        </header>

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
                    @foreach($users as $user)
                        {{-- On retire la balise <a> autour du <tr> --}}
                        <tr class="group cursor-pointer {{ $user->is_banned ? 'bg-red-50/30 hover:bg-red-50' : 'hover:bg-gray-50/50' }} transition"
                            onclick="window.location='{{ route('admin.users.show', $user) }}'">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background={{ $user->is_banned ? '333' : '1CC29F' }}&color=fff"
                                         class="w-9 h-9 rounded-full shadow-sm {{ $user->is_banned ? 'grayscale' : '' }}">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-xs">
                                @if($user->is_banned)
                                    <span class="px-3 py-1 rounded-full font-bold status-banned uppercase tracking-tighter bg-red-100 text-red-600">Banni</span>
                                @else
                                    <span class="px-3 py-1 rounded-full font-bold status-active bg-emerald-100 text-emerald-700">Actif</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-sm {{ $user->colocation ? 'text-gray-900 font-bold' : 'text-gray-400 italic' }}">
                                {{ $user->colocation->name ?? '— Aucun —' }}
                            </td>

                            {{-- IMPORTANT : On ajoute onclick="event.stopPropagation()" pour éviter de déclencher le lien du profil quand on clique sur un bouton --}}
                            <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                                @if($user->id === auth()->id())
                                    <span class="text-xs text-gray-400 italic">Vous</span>
                                @elseif($user->is_banned)
                                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-emerald-500 hover:text-emerald-700 transition font-bold text-xs uppercase">
                                            Réactiver
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir bannir {{ addslashes($user->name) }} ?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2" title="Bannir">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
