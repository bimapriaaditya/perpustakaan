<?php

namespace App;

use App\Penerbit;
use App\Author;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'nama','detail','penerbit_id','author_id','deskripsi'
    ];

    public function penerbit()
    {
        return $this->hasOne('App\Penerbit', 'id', 'penerbit_id');
    }

    public function author()
    {
        return $this->hasOne('App\Author', 'id', 'author_id');
    }
}
