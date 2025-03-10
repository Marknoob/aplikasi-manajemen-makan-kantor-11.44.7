<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('menuDeck')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'tanggal_transaksi' => 'nullable|date',
            'catatan' => 'nullable|string',
        ]);

        $transaction->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }
}
