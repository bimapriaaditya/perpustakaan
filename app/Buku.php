<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'nama','detail','id_penerbit','id_author','deskripsi'
    ];

    public function penerbit()
    {
        return $this->hasOne('App\Penerbit');
    }

    public function author()
    {
        return $this->hasOne('App\Author');
    }
}
