@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 md:p-10">

    @guest
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 text-center">
            <p class="text-gray-600 mb-4">Vous devez être connecté pour accepter cette invitation.</p>
            <a href="{{ route('login') }}?redirect={{ urlencode(request()->url()) }}" class="inline-block bg-brand-green text-white px-6 py-3 rounded-xl font-bold">
                Se connecter
            </a>
        </div>
    @else
        @if(auth()->user()->email !== $invitation->email)
            <div class="bg-red-50 border border-red-200 rounded-3xl p-8 text-center">
                <p class="text-red-700 font-medium">Cette invitation est destinée à {{ $invitation->email }}.</p>
                <p class="text-gray-600 text-sm mt-2">Connectez-vous avec le bon compte pour accepter.</p>
            </div>
        @else
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-2xl brand-green mx-auto mb-6">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h1 class="text-2xl font-black text-gray-900 mb-2">Invitation à rejoindre</h1>
                    <p class="text-3xl font-black brand-green mb-6">{{ $invitation->colocation->name }}</p>
                    <p class="text-gray-500 text-sm mb-8">Vous avez été invité à rejoindre cette colocation.</p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto bg-brand-green text-white px-8 py-3 rounded-xl font-bold hover:bg-emerald-600 transition">
                                <i class="fas fa-check mr-2"></i> Accepter
                            </button>
                        </form>
                        <form action="{{ route('invitations.reject', $invitation->token) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto border border-gray-200 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                                <i class="fas fa-times mr-2"></i> Refuser
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endguest

</div>
@endsection
