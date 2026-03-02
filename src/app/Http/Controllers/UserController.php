<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('membreship.colocation')
        ->where('id', '!=', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10); 

        return view('admin.users.index', compact('users'));
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Empêcher un admin de se bannir lui-même
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas bannir votre propre compte.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        $message = $user->is_banned
            ? "L'utilisateur {$user->name} a été banni. Il ne pourra plus accéder à la plateforme."
            : "L'utilisateur {$user->name} a été réactivé avec succès.";

        return redirect()->back()->with('success', $message);
    }
}
