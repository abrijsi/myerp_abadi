<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'tanggal',
        'no_faktur',
        'jumlah_faktur',
        'jumlah_pembayaran',
        'paid',
        'telat',
        'tgl_jtt',
        'kd_pelanggan',
        'nama_pelanggan',
    ];
}
