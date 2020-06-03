<?php

namespace App;

use App\Penerbit;
use App\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'nama','detail','penerbit_id','author_id','deskripsi', 'img'
    ];

    public function penerbit()
    {
        return $this->hasOne('App\Penerbit', 'id', 'penerbit_id');
    }

    public function author()
    {
        return $this->hasOne('App\Author', 'id', 'author_id');
    }

    public function deleteSampul()
    {
        $path = "img/buku/$this->img";
        return unlink($path);
    }
}
