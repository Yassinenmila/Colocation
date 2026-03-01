@extends('layouts.dashboard')

@section('dashboard-content')
    <main class="flex-1 p-6 md:p-10">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Salut {{ $user->name }} 👋
                </h1>
                @if($colocation)
                    <p class="text-gray-500">
                        Voici un aperçu de ta colocation <span class="font-bold">{{ $colocation->name }}</span>.
                    </p>
                @else
                    <p class="text-gray-500">
                        Tu n'as pas encore de colocation active. Crée-en une ou accepte une invitation.
                    </p>
                @endif
            </div>
            @if($colocation)
                <a href="{{ route('colocations.show', $colocation->id) }}"
                   class="bg-brand-green text-white px-6 py-2.5 rounded-lg font-bold shadow-sm flex items-center gap-2 self-start md:self-center">
                    <i class="fas fa-home"></i> Voir ma colocation
                </a>
            @else
                <a href="{{ route('colocations.index') }}"
                   class="bg-brand-green text-white px-6 py-2.5 rounded-lg font-bold shadow-sm flex items-center gap-2 self-start md:self-center">
                    <i class="fas fa-plus"></i> Créer une colocation
                </a>
            @endif
        </header>

        @if($colocation)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-gray-400 text-sm font-medium uppercase mb-2">Total dépenses</p>
                    <p class="text-3xl font-extrabold text-gray-900">
                        {{ number_format($stats['total_depenses'], 2, ',', ' ') }} €
                    </p>
                    <p class="text-xs text-gray-400 mt-2 italic font-medium leading-none">
                        {{ $stats['count_depenses'] }} dépense(s) enregistrée(s)
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-gray-400 text-sm font-medium uppercase mb-2">Paiements</p>
                    <p class="text-3xl font-extrabold brand-green">
                        {{ $stats['count_payments'] }}
                    </p>
                    <p class="text-xs text-gray-400 mt-2 italic font-medium leading-none">
                        Règlements entre colocataires
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-gray-400 text-sm font-medium uppercase mb-2">Membres</p>
                    <p class="text-3xl font-extrabold text-gray-900">
                        {{ $stats['members_count'] }}
                    </p>
                    <p class="text-xs text-gray-400 mt-2 italic font-medium leading-none">
                        Personnes dans la colocation
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-gray-400 text-sm font-medium uppercase mb-2">Rôle</p>
                    <p class="text-3xl font-extrabold {{ $membership && $membership->role === 'owner' ? 'brand-green' : 'text-gray-900' }}">
                        {{ strtoupper($membership?->role ?? '—') }}
                    </p>
                    <p class="text-xs text-gray-400 mt-2 italic font-medium leading-none">
                        Ton statut dans la colocation
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h2 class="font-bold text-gray-800">Dernières dépenses</h2>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($lastDepenses as $depense)
                            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">{{ $depense->title }}</p>
                                        <p class="text-[11px] text-gray-400 italic">
                                            Payé par {{ $depense->user->name ?? '—' }}
                                            • {{ $depense->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold">
                                        {{ number_format($depense->amount, 2, ',', ' ') }} €
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-400 text-sm italic">
                                Aucune dépense enregistrée pour le moment.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <h2 class="font-bold text-gray-800 mb-6">Membres du foyer</h2>
                        <div class="space-y-4">
                            @forelse($colocation->membreships as $m)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs italic">
                                            {{ strtoupper(substr($m->user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">{{ $m->user->name }}</span>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded italic font-medium
                                        {{ $m->role === 'owner' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $m->role === 'owner' ? 'Propriétaire' : 'Membre' }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">Aucun autre membre.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-brand-green p-6 rounded-2xl shadow-lg text-white">
                        <h2 class="font-bold mb-4">Derniers paiements</h2>
                        @forelse($lastPayments as $payment)
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-bold text-sm">
                                        {{ $payment->fromUser->name ?? '—' }} → {{ $payment->toUser->name ?? '—' }}
                                    </p>
                                    @if($payment->commentaire)
                                        <p class="text-xs opacity-80 italic">{{ $payment->commentaire }}</p>
                                    @endif
                                    <p class="text-[10px] opacity-70 mt-1">{{ $payment->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <p class="font-extrabold">
                                    {{ number_format($payment->amount, 2, ',', ' ') }} €
                                </p>
                            </div>
                        @empty
                            <p class="text-sm opacity-80 italic">Aucun paiement enregistré pour le moment.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        @else
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center">
                <h2 class="text-xl font-bold text-gray-900 mb-2">Bienvenue sur ton tableau de bord</h2>
                <p class="text-gray-500 mb-6">
                    Crée ta première colocation ou accepte une invitation pour commencer à suivre vos dépenses.
                </p>
                <a href="{{ route('colocations.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-brand-green text-white rounded-xl font-bold shadow hover:bg-emerald-600 transition">
                    <i class="fas fa-plus"></i> Créer une colocation
                </a>
            </div>
        @endif
    </main>
@endsection
