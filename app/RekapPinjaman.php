<?php

namespace App;

use App\Buku;
use Illuminate\Database\Eloquent\Model;

class RekapPinjaman extends Model
{
    protected $table = 'rekap_pinjaman';

    protected $fillable = [
        'buku_id', 'tahun', 'bulan', 'jumlah'
    ];

    public function buku()
    {
        return $this->belongsTo('App\Buku');
    }
}
