<?php

namespace App;

use App\Author;
use App\Buku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Penerbit extends Model
{
    protected $table = 'penerbit';

    protected $fillable = [
        'nama', 'deskripsi' ,'img'
    ];

    public function buku()
    {
        return $this->belongsTo('App\Buku', 'id');
    }

    public function deletePhoto()
    {
        $path = Storage::url('img/penerbit/' . $this->img);
        return unlink($path);
    }

}
