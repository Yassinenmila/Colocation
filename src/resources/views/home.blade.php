@extends('layouts.app')
@section('content')
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 space-y-6">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight leading-tight">
                La colocation <br><span class="brand-green text-gray-900">en toute sérénité.</span>
            </h1>
            <p class="text-xl text-gray-500 max-w-lg leading-relaxed">
                Gérez vos dépenses, planifiez les tâches ménagères et centralisez vos documents. L'outil tout-en-un pour des colocataires heureux.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button class="bg-brand-green text-white px-8 py-4 rounded-lg text-lg font-bold shadow-lg transition">Démarrer ma coloc</button>
                <button class="flex items-center justify-center gap-2 border border-gray-300 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-50 transition">
                    <i class="fab fa-apple"></i> App Store
                </button>
            </div>
        </div>
        <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-2xl w-full max-w-sm rotate-2 hover:rotate-0 transition duration-500">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <span class="font-bold text-gray-400 uppercase text-xs tracking-widest">Aujourd'hui</span>
                    <i class="fas fa-ellipsis-h text-gray-400"></i>
                </div>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-orange-400 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-semibold">Tu dois 15,50 €</p>
                            <p class="text-xs text-gray-400 text-gray-500">à Antoine (Courses)</p>
                        </div>
                        <button class="text-xs font-bold brand-green uppercase">Régler</button>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-brand-green flex justify-between items-center">
                        <div>
                            <p class="text-sm font-semibold italic line-through text-gray-400">Sortir les poubelles</p>
                            <p class="text-xs text-brand-green font-bold">Terminé ✅</p>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-400">
                        <p class="text-sm font-semibold">Loyer de Mars</p>
                        <div class="flex gap-1 mt-2">
                            <div class="h-2 w-full bg-brand-green rounded-full"></div>
                            <div class="h-2 w-full bg-brand-green rounded-full"></div>
                            <div class="h-2 w-full bg-gray-200 rounded-full"></div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2">2/3 colocataires ont payé</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Moins de calculs, plus de moments partagés.</h2>
                <div class="h-1 w-20 bg-brand-green mx-auto"></div>
            </div>

            <div class="grid md:grid-rows-3 gap-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-4">
                        <div class="bg-brand-green/10 w-12 h-12 rounded-full flex items-center justify-center brand-green text-xl">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Équilibre des comptes en 2 secondes</h3>
                        <p class="text-gray-600">Ajoutez vos dépenses courantes. Notre algorithme réduit automatiquement le nombre de virements nécessaires entre vous.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 italic text-gray-500">
                        "C'est nous qui faisons les maths pour que vous n'ayez pas à le faire."
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1 bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex gap-4">
                            <div class="h-4 w-4 bg-gray-200 rounded"></div>
                            <div class="h-4 w-3/4 bg-gray-100 rounded"></div>
                        </div>
                        <div class="flex gap-4 mt-4">
                            <div class="h-4 w-4 bg-brand-green rounded"></div>
                            <div class="h-4 w-1/2 bg-gray-100 rounded"></div>
                        </div>
                    </div>
                    <div class="order-1 md:order-2 space-y-4">
                        <div class="bg-brand-green/10 w-12 h-12 rounded-full flex items-center justify-center brand-green text-xl">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Planning de ménage rotatif</h3>
                        <p class="text-gray-600">Un système de tours clair pour que tout le monde participe équitablement. Finis les rappels passifs-agressifs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 text-center px-6">
        <h2 class="text-4xl font-extrabold mb-6">Prêt à simplifier votre vie ?</h2>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">Rejoignez des milliers de colocations qui utilisent notre application gratuitement.</p>
        <button class="bg-brand-green text-white px-10 py-4 rounded-full text-xl font-bold shadow-lg hover:scale-105 transition transform">Créer ma colocation</button>
    </section>
@endsection
    
