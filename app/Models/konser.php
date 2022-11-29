<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konser extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama",
        "tanggal",
        "alamat",
        "kuota_penonton",
        "harga",
        "deskripsi",
        "poster",
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
