<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Membreship;

class AdminController extends Controller
{
   public function index()
{
    $user = auth()->user();

    $membership = Membreship::where('user_id', $user->id)
        ->whereNull('left_at')
        ->first();

    $colocation = null;
    $stats = [
        'total_depenses' => 0,
        'count_depenses' => 0,
        'count_payments' => 0,
        'members_count' => 0,
    ];
    $lastDepenses = collect();
    $lastPayments = collect();
    $members = collect(); // <-- ajout pour les membres

    if ($membership) {
        $colocation = Colocation::with([
            'membreships.user',
            'depenses.user',
            'payments.fromUser',
            'payments.toUser',
        ])->find($membership->colocation_id);

        if ($colocation) {
            $stats['total_depenses'] = $colocation->depenses->sum('amount');
            $stats['count_depenses'] = $colocation->depenses->count();
            $stats['count_payments'] = $colocation->payments->count();
            $stats['members_count'] = $colocation->membreships->count();

            $lastDepenses = $colocation->depenses->sortByDesc('created_at')->take(5);
            $lastPayments = $colocation->payments->sortByDesc('created_at')->take(5);

            $members = $colocation->membreships->pluck('user');

            foreach ($lastDepenses as $depense) {
   $otherMembers = $members->filter(fn($m) => $m->id !== $depense->user_id);
$reste = $depense->amount; // montant total

// On considère que le créateur a payé sa part
$part_du_createur = $depense->amount / $members->count();
$reste_a_partager = $depense->amount - $part_du_createur;

$part = $otherMembers->count() > 0
    ? $reste_a_partager / $otherMembers->count()
    : 0;

    // Tableau associatif [user_id => montant à payer]
    $depense->members_part = $members->mapWithKeys(function($m) use ($depense, $part, $part_du_createur) {
    return [$m->id => $m->id === $depense->user_id ? $part_du_createur : $part];
});
}

            foreach ($lastPayments as $payment) {
                $payment->fromUser = $payment->fromUser;
                $payment->toUser = $payment->toUser;
            }
        }
    }

    return view('admin.dashboard', compact(
        'user',
        'colocation',
        'stats',
        'lastDepenses',
        'lastPayments',
        'membership',
        'members' // <-- on passe les membres à la vue
    ));
}
}
