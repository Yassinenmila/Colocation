<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membreship;

class MemberController extends Controller
{
   public function remove($id)
    {
        $member = Membreship::findOrFail($id);

        if ($member->role === 'owner') {
            return back()->withErrors(['error' => 'Impossible de retirer le propriétaire.']);
        }

        $member->delete();

        return back()->with('success', 'Membre retiré avec succès.');
    }

    public function leave()
{
    $user = auth()->user();

    $membership = Membreship::where('user_id', $user->id)
        ->whereNull('left_at')
        ->first();

    if (!$membership) {
        return back()->withErrors(['error' => 'Vous n\'êtes membre d\'aucune colocation active.']);
    }

    if ($membership->role === 'owner') {
        return back()->withErrors(['error' => 'Le propriétaire doit supprimer la colocation pour la quitter.']);
    }

    $colocationId = $membership->colocation_id;


    $unpaidDebts = Payment::where('from_user_id', $user->id)
        ->where('colocation_id', $colocationId)
        ->where('status', 'pending')
        ->count();

    if ($unpaidDebts > 0) {
        $user->reputation -= 1;
    } else {
        $user->reputation += 1;
    }

    $user->save();

    $membership->left_at = now();
    $membership->save();

    return redirect()->route('home')
        ->with('success', 'Vous avez quitté la colocation avec succès.');
}
}
