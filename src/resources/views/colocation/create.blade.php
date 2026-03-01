<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Départ | ColocApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F9FAFB; }
        .brand-green { color: #1CC29F; }
        .bg-brand-green { background-color: #1CC29F; }
        .shadow-huge { box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.08); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-emerald-50 rounded-full blur-[120px] opacity-60"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-blue-50 rounded-full blur-[120px] opacity-60"></div>
    </div>

    <div class="max-w-2xl w-full relative z-10">

        <div class="flex flex-col items-center mb-12">
            <div class="w-20 h-20 bg-white rounded-[2rem] shadow-huge flex items-center justify-center text-3xl brand-green mb-6">
                <i class="fas fa-home"></i>
            </div>
            <h1 class="text-sm font-black uppercase tracking-[0.4em] text-gray-400 italic">Nouvelle Aventure</h1>
        </div>

        <div class="bg-white rounded-[4rem] p-12 md:p-20 shadow-huge border border-white relative overflow-hidden text-center">

            <header class="mb-12">
                <h2 class="text-5xl font-black italic tracking-tighter text-gray-900 leading-none">
                    Comment s'appelle <br> <span class="brand-green">votre Colocation ?</span>
                </h2>
                <p class="text-gray-400 text-sm mt-6 font-medium italic">Ce nom sera visible par tous les futurs membres.</p>
            </header>

            <form action="{{ route('colocations.store') }}" method="POST" class="space-y-10">
                @csrf
                <div class="relative group">
                    <input type="text"
                        placeholder="Le nom de la coloc..."
                        name="name"
                        class="w-full bg-gray-50/50 border-2 border-transparent rounded-[2.5rem] py-8 px-10 text-2xl font-black text-center focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all outline-none text-gray-800 placeholder:text-gray-200 shadow-inner">
                </div>

                <div class="flex flex-col items-center gap-6">
                    <button type="submit"
                        class="group bg-gray-900 text-white px-12 py-6 rounded-[2.5rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl hover:bg-emerald-500 transition-all duration-300 transform hover:scale-105 active:scale-95">
                        Créer la colocation <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                    </button>

                    <a href="{{ route('home') }}" class="text-[10px] font-black text-gray-300 uppercase tracking-widest hover:text-gray-900 transition-colors">
                        <i class="fas fa-times mr-2"></i> Annuler la création
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
