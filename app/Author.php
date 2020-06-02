<?php

namespace App;

use App\Buku;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';

    protected $fillable = [
        'nama', 'deskripsi'
    ];

    public function buku()
    {
        return $this->belongsTo('App\Buku', 'id');
    }
}
