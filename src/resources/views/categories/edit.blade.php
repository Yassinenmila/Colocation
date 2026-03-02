@extends ('layouts.dashboard')

@section('dashboard-content')
    <div class="max-w-3xl mx-auto p-6 md:p-10">
        <header class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">modifier une catégorie</h1>
            <p class="text-gray-500 font-medium">modifier la catégorie de dépenses </p>
        </header>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden p-8">
            <form action="{{ route('categories.update', $categorie->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Nom de la catégorie</label>
                    <input type="text" name="name" value="{{ $categorie->name }}" required
                        class="w-full bg-gray-50 border-none rounded-2xl py-5 px-6 font-black text-gray-900 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all placeholder:text-gray-300"
                        placeholder="Ex: Alimentation, Internet...">
                </div>

                <button type="submit" class="w-full bg-brand-green text-white py-5 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-100 hover:translate-y-[-2px] transition-all">
                    modifier la catégorie
                </button>
            </form>
        </div>
    </div>
@endsection
