<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $transactions = Auth::user()->transactions()->latest()->get();
        // $saving = Auth::user()->savings;

        // return view('staff.data-transaksi.index', compact('transactions', 'saving'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saving = Auth::user()->savings;

        return view('transactions.create', compact('saving'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $user = Auth::user();  // Ambil user saat ini

        // Ambil tabungan pertama user
        $saving = $user->savings()->first();

        if (! $saving || $saving->amount < $request->amount) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi');
        }

        // Kurangi tabungan
        $saving->amount -= $request->amount;
        $saving->save();

        // Simpan transaksi
        Transaction::create([
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date,
            'user_id' => $user->id,
            'savings_id' => $saving ? $saving->id : null,
        ]);

        return redirect()->route('index')->with('success', 'Transaksi berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete(); // Soft delete

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus sementara');
    }
}
