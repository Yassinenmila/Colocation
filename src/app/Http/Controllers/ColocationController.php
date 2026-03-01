<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Membreship;

class ColocationController extends Controller
{

    public function index()
    {
        $user= auth()->user();

        if (!$user->membreships) {
            return redirect()->route('colocations.create');
        }

    return redirect()->route('colocations.show', $user->membreships->colocation_id);



    }

    public function create()
    {
        $user = auth()->user();

        // Un utilisateur déjà membre ou owner d'une colocation ne peut pas en créer une autre
        $hasActiveColocation = Membreship::where('user_id', $user->id)
            ->whereNull('left_at')
            ->exists();

        if ($hasActiveColocation) {
            $membership = Membreship::where('user_id', $user->id)->whereNull('left_at')->first();
            return redirect()->route('colocations.show', $membership->colocation_id)
                ->with('error', 'Vous êtes déjà membre d\'une colocation. Vous devez la quitter avant d\'en créer une nouvelle.');
        }

        return view('colocation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        // Un utilisateur déjà membre ou owner d'une colocation ne peut pas en créer une autre
        $hasActiveColocation = Membreship::where('user_id', $user->id)
            ->whereNull('left_at')
            ->exists();

        if ($hasActiveColocation) {
            return redirect()->back()->with('error', 'Vous êtes déjà membre d\'une colocation. Vous devez la quitter avant d\'en créer une nouvelle.');
        }

        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => $user->id,
        ]);

        $membre=Membreship::create([
            'user_id' => $user->id,
            'colocation_id' => $colocation->id,
            'role' => 'owner',
            'joined_at' => now(),
            'left_at'=>null,
        ]);

        return redirect()->route('colocations.index')->with('success', 'Colocation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $colocation = Colocation::with([
            'membreships.user',
            'depenses.user',
            'depenses.category',
            'categories',
            'invitations',
            'payments.fromUser',
            'payments.toUser',
        ])->findOrFail($id);

        // Admin peut voir toute colocation, les users uniquement la leur
        $user = auth()->user();
        $isMember = $colocation->membreships->contains('user_id', $user->id);
        if (!$isMember && $user->role !== 'admin') {
            abort(403, 'Vous n\'avez pas accès à cette colocation.');
        }

        return view('colocation.show', compact('colocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
