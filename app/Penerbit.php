<?php

namespace App;

use App\Author;
use App\Buku;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';

    protected $fillable = [
        'nama','img'
    ];

    public function buku()
    {
        return $this->belongsTo('App\Buku', 'id');
    }

}
