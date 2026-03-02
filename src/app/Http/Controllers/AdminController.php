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
            }
        }

        return view('admin.dashboard', compact(
            'user',
            'colocation',
            'stats',
            'lastDepenses',
            'lastPayments',
            'membership'
        ));
    }
}
