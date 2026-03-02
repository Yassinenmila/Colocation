<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $colocation_id = $user->membreship?->colocation_id;
        $users= $user->membreship?->colocation?->membreships?->pluck('user')->where('id', '!=', $user->id) ?? collect();

        return view('payments.create' , compact('colocation_id', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'to_user_id' => 'required|exists:users,id',
        ]);

        $validatedData['from_user_id'] = auth()->id();
        $validatedData['colocation_id'] = auth()->user()->membreship->colocation_id;

        \App\Models\Payment::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Paiement enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
