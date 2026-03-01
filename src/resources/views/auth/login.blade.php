<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion | NexusFlow</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex bg-white">

<!-- SECTION FORM -->
<div class="w-full lg:w-2/5 flex items-center justify-center px-8">
  <div class="w-full max-w-sm space-y-6">

    <h2 class="text-3xl font-bold text-slate-900">Bon retour 👋</h2>
    <p class="text-slate-500 text-sm">
      Connectez-vous à votre espace.
    </p>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form class="space-y-5" method="POST" action="{{ route('signin') }}">
        @csrf
        @if(!empty($redirect ?? request()->get('redirect')))
            <input type="hidden" name="redirect" value="{{ $redirect ?? request()->get('redirect') }}">
        @endif
        @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
      <!-- EMAIL -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
          Email
        </label>
        <input name="email" type="email" value="{{ old('email') }}" placeholder="nom@entreprise.fr" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      </div>

      <div>
        <div class="flex justify-between items-center mb-2">
          <label class="text-sm font-medium text-slate-700">
            Mot de passe
          </label>
          <a href="#" class="text-sm text-blue-600 hover:text-blue-700">
            Oublié ?
          </a>
        </div>
        @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
        <input name="password" type="password" placeholder="••••••••" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      </div>

      <div class="flex items-center">
        <input type="checkbox" class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
        <label class="ml-2 text-sm text-slate-600">
          Rester connecté
        </label>
      </div>

      <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-semibold shadow-md hover:bg-blue-600 active:scale-95 transition">
        Se connecter
      </button>
    </form>
    <p class="text-center text-sm text-slate-600">
      Pas de compte ?
      <a href="{{ route('signup') }}" class="text-blue-600 font-semibold hover:underline">
        Créer un profil
      </a>
    </p>
  </div>
</div>
<div class="hidden lg:block lg:w-3/5 relative">
  <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" alt="Bureau">
</div>

</body>
</html>
