<?php

namespace App;

use App\Buku;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable =  [
        'buku_id', 'user_id', 'quantity'
    ];

    public function buku()
    {
        return $this->hasOne('App\Buku', 'id', 'buku_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}