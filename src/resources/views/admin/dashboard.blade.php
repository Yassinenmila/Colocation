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
                    <div class="mt-6 flex gap-4">
    @if($membership->role === 'owner')
        <form action="{{ route('colocations.destroy', $colocation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler la colocation ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded font-bold">
                Annuler la colocation
            </button>
        </form>
    @else
        <form action="{{ route('colocations.leave') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment quitter la colocation ?');">
            @csrf
            @method('POST')
            <button type="submit" class="px-4 py-2 bg-gray-400 text-white rounded font-bold">
                Quitter la colocation
            </button>
        </form>
    @endif
</div>
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
            {{-- Stats Colocation --}}
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

            {{-- Dépenses et Paiements --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                {{-- Dernières Dépenses --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h2 class="font-bold text-gray-800">Dernières dépenses</h2>
                        <a href="{{ route('depenses.create') }}"
                           class="px-4 py-2 bg-brand-green text-white rounded hover:bg-emerald-600 transition text-sm font-medium">
                           + Ajouter une dépense
                        </a>
                    </div>
                    <div class="divide-y divide-gray-50">
                       @foreach($lastDepenses as $depense)
    <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
        <div class="flex justify-between mb-2">
            <p class="font-bold">{{ $depense->title }} ({{ number_format($depense->amount,2,',',' ') }} DH)</p>
            <p class="text-xs text-gray-400">{{ $depense->created_at->format('d M Y') }}</p>
        </div>

        @foreach($members as $member)
            @if($member->id !== $depense->user_id) {{-- pas le créateur --}}
                <div class="flex justify-between items-center mb-1">
                    <span>{{ $member->name }}</span>
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="from_user_id" value="{{ $member->id }}">
                        <input type="hidden" name="to_user_id" value="{{ $depense->user_id }}">
                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                        <input type="hidden" name="depense_id" value="{{ $depense->id }}">
                        <input type="hidden" name="amount" value="{{ $depense->part }}"> {{-- montant fixe --}}
                        <button type="submit"
                                class="px-3 py-1 bg-green-600 text-white rounded text-xs font-bold">
                            Rembourser {{ number_format($depense->part,2,',',' ') }} DH
                        </button>
                    </form>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
                    </div>
                </div>

                {{-- Membres + Derniers Paiements --}}
                <div class="space-y-6">

                    {{-- Membres --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <h2 class="font-bold text-gray-800 mb-6">Membres du foyer</h2>
                        <div class="space-y-4">
                           @foreach($colocation->membreships as $m)
    <div class="flex items-center justify-between mb-2">
        <span>{{ $m->user->name }}</span>
        <span class="text-xs px-2 py-1 rounded italic font-medium
            {{ $m->role === 'owner' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }}">
            {{ $m->role === 'owner' ? 'Propriétaire' : 'Membre' }}
        </span>

        @if($membership && $membership->role === 'owner' && $m->role !== 'owner')
            <form action="{{ route('members.remove', $m->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1 bg-red-600 text-white rounded text-xs font-bold hover:bg-red-700">
                    Retirer
                </button>
            </form>
        @endif
    </div>
@endforeach
                        </div>
                    </div>

                    {{-- Derniers Paiements --}}
                    <div class="bg-brand-green p-6 rounded-2xl shadow-lg text-white">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="font-bold">Derniers paiements</h2>
                            <a href="{{ route('payments.create') }}"
                               class="px-4 py-2 bg-white text-black rounded hover:bg-gray-100 transition text-sm font-medium">
                               + Ajouter un paiement
                            </a>
                        </div>
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
                                <div class="flex flex-col items-end gap-2">
                                    <p class="font-extrabold">
                                        {{ number_format($payment->amount, 2, ',', ' ') }} €
                                    </p>

                                </div>
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
