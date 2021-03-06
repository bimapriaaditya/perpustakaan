<?php

namespace App;

use App\Buku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Author extends Model
{
    protected $table = 'author';

    protected $fillable = [
        'nama', 'deskripsi', 'img'
    ];

    public function buku()
    {
        return $this->belongsTo('App\Buku', 'id');
    }

    public function deletePhoto()
    {
        $path = Storage::url('img/author/'.$this->img);
        return unlink($path);
    }
}
