<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription | NexusFlow</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex bg-white">

<!-- SECTION FORM -->
<div class="w-full lg:w-2/5 flex items-center justify-center px-8">
  <div class="w-full max-w-sm space-y-6">

    <h2 class="text-3xl font-bold text-slate-900">
      Créer un compte 🚀
    </h2>
    <p class="text-slate-500 text-sm">
      Rejoignez NexusFlow et commencez dès aujourd’hui.
    </p>

    <form class="space-y-5">

      <!-- NAME -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
          Nom complet
        </label>
        <input type="text"
          placeholder="Votre nom"
          class="w-full px-4 py-3 border border-slate-300 rounded-xl
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 focus:border-blue-500 transition">
      </div>

      <!-- EMAIL -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
          Email
        </label>
        <input type="email"
          placeholder="nom@entreprise.fr"
          class="w-full px-4 py-3 border border-slate-300 rounded-xl
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 focus:border-blue-500 transition">
      </div>

      <!-- PASSWORD -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
          Mot de passe
        </label>
        <input type="password"
          placeholder="••••••••"
          class="w-full px-4 py-3 border border-slate-300 rounded-xl
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 focus:border-blue-500 transition">
      </div>

      <!-- CONFIRM PASSWORD -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
          Confirmer le mot de passe
        </label>
        <input type="password"
          placeholder="••••••••"
          class="w-full px-4 py-3 border border-slate-300 rounded-xl
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 focus:border-blue-500 transition">
      </div>

      <!-- TERMS -->
      <div class="flex items-start">
        <input type="checkbox"
          class="h-4 w-4 mt-1 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
        <label class="ml-2 text-sm text-slate-600">
          J’accepte les
          <a href="#" class="text-blue-600 font-medium hover:underline">
            conditions d’utilisation
          </a>
        </label>
      </div>

      <!-- BUTTON -->
      <button type="submit"
        class="w-full bg-slate-900 text-white py-3 rounded-xl
               font-semibold shadow-md hover:bg-blue-600
               active:scale-95 transition">
        Créer mon compte
      </button>

    </form>

    <p class="text-center text-sm text-slate-600">
      Déjà inscrit ?
      <a href="#" class="text-blue-600 font-semibold hover:underline">
        Se connecter
      </a>
    </p>

  </div>
</div>

<!-- SECTION IMAGE -->
<div class="hidden lg:block lg:w-3/5 relative">
  <img class="absolute inset-0 w-full h-full object-cover"
       src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop"
       alt="Bureau">
</div>

</body>
</html>
