<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenusDeck;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenusDeckController extends Controller
{
    public function index()
    {
        $menusDeck = MenusDeck::with('transaction')
        ->get()
        ->map(function ($menuDeck) {
            $menuDeck->hasPaidTransaction = $menuDeck->transaction && $menuDeck->transaction->status_transaksi;
            return $menuDeck;
        });

        return view('menus-deck.index', compact('menusDeck'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('menus-deck.create', compact('menus'));
    }

    public function show(MenusDeck $menusDeck)
    {
        return view('menus-deck.show', compact('menusDeck'));
    }

    public function edit(MenusDeck $menusDeck)
    {
        return view('menus-deck.edit', compact('menusDeck'),[
            'menus' => Menu::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'total_serve' => 'nullable|numeric|min:1',
            'status' => 'required|string|in:On-going,Planned,Done',
            'tanggal_pelaksanaan' => 'nullable|date',
        ]);

        $menusDeck = MenusDeck::create([
            'menu_id' => $request->menu_id,
            'total_serve' => $request->total_serve,
            'status' => $request->status,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
        ]);

        // Buat transaksi otomatis berdasarkan MenusDeck yang baru dibuat
        $menusDeck->transaction()->create([
            'status_transaksi' => false,
            'tanggal_transaksi' => now(),
            'file_path' => null,
            'catatan' => null,
        ]);

        return redirect()->route('menus-deck.index')->with('success', 'Menu Deck berhasil ditambahkan.');
    }

    public function update(Request $request, MenusDeck $menusDeck)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'total_serve' => 'nullable|numeric|min:1',
            'status' => 'required|string|in:On-going,Planned,Done',
            'tanggal_pelaksanaan' => 'nullable|date',
        ]);
        $menusDeck->update([
            'menu_id' => $request->menu_id,
            'total_serve' => $request->total_serve,
            'status' => $request->status,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
        ]);

        return redirect()->route('menus-deck.index')->with('success', 'Menu Deck berhasil diperbarui.');
    }
}
