<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\Membreship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        $colocation = Colocation::findOrFail($request->colocation_id);
        $inviter = auth()->user();

        // Seul le propriétaire (owner) peut inviter des membres
        $inviterMembership = $colocation->membreships->firstWhere('user_id', $inviter->id);
        if (!$inviterMembership || $inviterMembership->role !== 'owner') {
            return redirect()->back()->with('error', 'Seul le propriétaire de la colocation peut inviter des membres.');
        }

        // Ne pas s'inviter soi-même
        if ($inviter->email === $request->email) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous inviter vous-même.');
        }

        // Vérifier que l'utilisateur existe
        $invitedUser = User::where('email', $request->email)->first();
        if (!$invitedUser) {
            return redirect()->back()->with('error', 'Aucun utilisateur inscrit avec cet email. La personne doit d\'abord créer un compte.');
        }

        // Vérifier que l'utilisateur n'est pas déjà dans une colocation (membreship active avec left_at = null)
        $activeMembership = Membreship::where('user_id', $invitedUser->id)
            ->whereNull('left_at')
            ->first();

        if ($activeMembership) {
            if ($activeMembership->colocation_id === $colocation->id) {
                return redirect()->back()->with('error', 'Cette personne est déjà membre de votre colocation.');
            }
            return redirect()->back()->with('error', 'Cette personne est déjà dans une autre colocation. Elle doit d\'abord quitter sa colocation actuelle.');
        }

        // Vérifier qu'il n'y a pas déjà une invitation en attente
        $existingInvitation = Invitation::where('colocation_id', $colocation->id)
            ->where('email', $request->email)
            ->where('status', 'pending')
            ->first();

        if ($existingInvitation) {
            return redirect()->back()->with('error', 'Une invitation a déjà été envoyée à cet email.');
        }

        Invitation::create([
            'email' => $request->email,
            'token' => Str::random(64),
            'status' => 'pending',
            'colocation_id' => $colocation->id,
        ]);

        return redirect()->back()->with('success', "Invitation envoyée à {$request->email}.");
    }

    /**
     * Afficher une invitation (page avec boutons Accepter/Refuser).
     */
    public function show(string $token)
    {
        $invitation = Invitation::with('colocation')
            ->where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        return view('invitations.show', compact('invitation'));
    }

    /**
     * Accepter une invitation.
     */
    public function accept(Request $request, string $token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        $user = auth()->user();

        // Vérifier que l'email correspond à l'utilisateur connecté
        if ($user->email !== $invitation->email) {
            return redirect()->route('dashboard')->with('error', 'Cette invitation ne vous est pas destinée.');
        }

        // Vérifier que l'utilisateur n'est pas déjà dans une colocation
        $activeMembership = Membreship::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if ($activeMembership) {
            $invitation->update(['status' => 'rejected']);
            return redirect()->route('dashboard')->with('error', 'Vous êtes déjà dans une colocation. Vous devez la quitter avant d\'accepter une invitation.');
        }

        Membreship::create([
            'user_id' => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member',
            'joined_at' => now(),
            'left_at' => null,
        ]);

        $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.show', $invitation->colocation_id)
            ->with('success', 'Bienvenue dans la colocation !');
    }

    /**
     * Refuser une invitation.
     */
    public function reject(Request $request, string $token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if (auth()->user()->email !== $invitation->email) {
            return redirect()->route('dashboard')->with('error', 'Cette invitation ne vous est pas destinée.');
        }

        $invitation->update(['status' => 'rejected']);

        return redirect()->route('dashboard')->with('success', 'Invitation refusée.');
    }
}
