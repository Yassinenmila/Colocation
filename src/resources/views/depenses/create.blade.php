@extends ('layouts.dashboard')

@section('dashboard-content')
<div class="min-h-screen flex items-center justify-center p-6" >
    <div class="w-full max-w-xl bg-white rounded-[3.5rem] shadow-2xl border border-gray-100 overflow-hidden">

        <div class="p-10 bg-gray-900 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl font-black italic tracking-tighter leading-none">
                    Nouvelle <span class="brand-green">Dépense.</span>
                </h1>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2 italic">
                    Enregistrez vos frais communs
                </p>
            </div>
            <i class="fas fa-receipt absolute -right-4 -bottom-4 text-8xl text-white/5 -rotate-12"></i>
        </div>

        <form action="{{ route('depenses.store') }}" method="POST" class="p-10 space-y-8">
            @csrf

            {{-- Montant --}}
            <div class="text-center space-y-2 bg-gray-50 p-8 rounded-[2.5rem] border border-gray-100">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Montant Total</label>
                <div class="flex items-center justify-center">
                    <input type="number" step="0.01" name="amount" required placeholder="0.00"
                        class="w-full text-5xl font-black text-center text-gray-900 border-none bg-transparent focus:ring-0 placeholder:text-gray-200">
                    <span class="text-xl font-black text-gray-300 italic ml-2">DH</span>
                </div>
            </div>

            {{-- Description --}}
            <div class="space-y-6">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Titre</label>
                    <input type="text" name="title" placeholder="Ex: Courses Carrefour..."
                        class="w-full bg-gray-50 border-none rounded-2xl py-5 px-8 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Description</label>
                    <input type="text" name="description" placeholder="Optionnel"
                        class="w-full bg-gray-50 border-none rounded-2xl py-5 px-8 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Catégorie</label>
                    <select name="category_id" required
                        class="w-full bg-gray-50 border-none rounded-2xl py-5 px-8 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all cursor-pointer appearance-none">
                        <option value="" disabled selected>Choisir une catégorie...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex flex-col gap-4">
                <button type="submit" class="w-full bg-brand-green text-white py-6 rounded-[2rem] font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-100 hover:scale-[1.02] active:scale-95 transition-all">
                    Enregistrer la dépense
                </button>
                <a href="{{ route('dashboard') }}" class="text-center text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-900 transition">
                    Annuler et retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
