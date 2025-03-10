<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'menu_deck_id',
        'tanggal_transaksi',
        'file_path',
        'catatan',
    ];

    public function menuDeck()
    {
        return $this->belongsTo(MenusDeck::class);
    }
}
