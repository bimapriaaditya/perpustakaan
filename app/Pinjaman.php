<?php

namespace App;

use App\Buku;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable =  [
        'buku_id', 'user_id', 'quantity', 'status', 'returned_at'
    ];

    public function buku()
    {
        return $this->hasOne('App\Buku', 'id', 'buku_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function status()
    {
        if($this->status == 2){
            echo "<span style='color:green;'>" . " Buku Telah Dikembalikan " . "</span>";
        }else{
            echo "<span style='color:red;'>" . " Buku Belum Dikembalikan " . "</span>";
        }
    }

    public function UpdateAt()
    {
        if($this->created_at == $this->updated_at){
            echo "<span style='color:red;'>" . "-" . "</span>";
        }else{
            echo "<span style='color:green;'>" . $this->updated_at . "</span>";
        }
    }
 
}
