<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "user_id",
        "pembelian_id",
        "nama",
        "metode_pembayaran",
        "bukti_pembayaran",
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
