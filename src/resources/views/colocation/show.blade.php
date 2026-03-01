@extends('layouts.dashboard')

@section('dashboard-content')
<div class="max-w-6xl mx-auto p-6 md:p-10">

    <div class="mb-8 flex justify-between items-center">
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.users.index') : route('dashboard') }}" class="text-gray-400 hover:text-gray-900 transition text-sm font-bold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> {{ auth()->user()->role === 'admin' ? 'Retour aux utilisateurs' : 'Retour au tableau de bord' }}
        </a>
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
                @if(auth()->user()->role === 'admin')
                    <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-bold rounded-full uppercase">Vue admin</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Dépenses</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->depenses->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ number_format($colocation->depenses->sum('amount'), 2, ',', ' ') }} € total</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Paiements</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->payments->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">règlements effectués</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Catégories</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->categories->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">catégories configurées</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm">
            <h2 class="font-black text-gray-900 uppercase tracking-widest text-xs mb-4 italic">Invitations</h2>
            <p class="text-2xl font-black brand-green">{{ $colocation->invitations->where('status', 'pending')->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">en attente</p>
        </div>
    </div>

    {{-- Membres --}}
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">
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
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 italic">Aucun membre pour le moment.</div>
            @endforelse
        </div>
    </div>

    {{-- Inviter un membre (réservé au propriétaire uniquement) --}}
    @php
        $currentUserMembership = $colocation->membreships->firstWhere('user_id', auth()->id());
    @endphp
    @if($currentUserMembership && $currentUserMembership->role === 'owner')
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <h2 class="text-sm font-bold text-gray-800 italic">Inviter un membre</h2>
                <i class="fas fa-user-plus text-gray-300"></i>
            </div>
            <div class="p-6">
                <p class="text-xs text-gray-500 mb-4">En tant que propriétaire, vous pouvez inviter des membres. Seuls les utilisateurs inscrits et <strong>non intégrés dans une autre colocation</strong> peuvent être invités.</p>
                <form action="{{ route('invitations.store') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    <input type="email" name="email" placeholder="Email de la personne à inviter"
                           class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                           value="{{ old('email') }}" required>
                    <button type="submit" class="px-6 py-2.5 bg-brand-green text-white rounded-xl font-bold hover:bg-emerald-600 transition">
                        <i class="fas fa-paper-plane mr-2"></i> Inviter
                    </button>
                </form>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                @if($colocation->invitations->where('status', 'pending')->count() > 0)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-3">Invitations en attente</p>
                        <div class="space-y-2">
                            @foreach($colocation->invitations->where('status', 'pending') as $inv)
                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-700">{{ $inv->email }}</span>
                                    <a href="{{ route('invitations.show', $inv->token) }}" target="_blank" class="text-xs text-emerald-600 font-bold hover:underline">
                                        Lien d'invitation
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Dépenses --}}
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <h2 class="text-sm font-bold text-gray-800 italic">Dépenses créées</h2>
                <i class="fas fa-receipt text-gray-300"></i>
            </div>
            <div class="divide-y divide-gray-50 max-h-80 overflow-y-auto">
                @forelse($colocation->depenses->sortByDesc('created_at') as $depense)
                    <div class="p-4 flex justify-between items-start hover:bg-gray-50/50 transition">
                        <div>
                            <p class="font-bold text-gray-900">{{ $depense->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Payé par <span class="font-medium text-gray-600">{{ $depense->user->name ?? '—' }}</span>
                                @if($depense->category)
                                    • {{ $depense->category->name }}
                                @endif
                            </p>
                            @if($depense->description)
                                <p class="text-xs text-gray-500 mt-1 italic">{{ Str::limit($depense->description, 50) }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="font-black text-emerald-600">{{ number_format($depense->amount, 2, ',', ' ') }} €</p>
                            <p class="text-[10px] text-gray-400">{{ $depense->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 italic">Aucune dépense enregistrée.</div>
                @endforelse
            </div>
        </div>

        {{-- Paiements --}}
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <h2 class="text-sm font-bold text-gray-800 italic">Paiements effectués</h2>
                <i class="fas fa-money-bill-transfer text-gray-300"></i>
            </div>
            <div class="divide-y divide-gray-50 max-h-80 overflow-y-auto">
                @forelse($colocation->payments->sortByDesc('created_at') as $payment)
                    <div class="p-4 flex justify-between items-start hover:bg-gray-50/50 transition">
                        <div>
                            <p class="font-bold text-gray-900 text-sm">
                                {{ $payment->fromUser->name ?? '—' }} → {{ $payment->toUser->name ?? '—' }}
                            </p>
                            @if($payment->commentaire)
                                <p class="text-xs text-gray-500 mt-0.5 italic">{{ Str::limit($payment->commentaire, 40) }}</p>
                            @endif
                            <p class="text-[10px] text-gray-400 mt-1">{{ $payment->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <p class="font-black text-emerald-600">{{ number_format($payment->amount, 2, ',', ' ') }} €</p>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 italic">Aucun paiement enregistré.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
