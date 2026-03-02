@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-black italic tracking-tighter text-gray-900 mb-10">
            Gestion <span class="text-emerald-500">Catégories.</span>
        </h1>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 italic">Créer une nouvelle catégorie</p>
            <form action="{{ route('categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                @csrf
                <input type="text" name="name" required placeholder="Nom de la catégorie..."
                    class="flex-1 bg-gray-50 border-none rounded-2xl py-4 px-6 font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                <button type="submit" class="bg-gray-900 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-500 transition-all">
                    Ajouter
                </button>
            </form>
        </div>

        <div class="space-y-3">
            @foreach($categories as $category)
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-folder text-sm"></i>
                    </div>
                    <span class="text-xl font-black italic text-gray-800">{{ $category->name }}</span>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('categories.edit', $category->id) }}"
                       class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition">
                        <i class="fas fa-pen text-xs"></i>
                    </a>

                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer ?')"
                                class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
