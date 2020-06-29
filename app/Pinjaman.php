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

    public static function getDays()
    {
        $user = auth()->user()->id;
        $pinjaman = self::where(
            [
                ['user_id', '=', $user],
                ['status', '=', '1'],
            ]
        )->get();
        foreach ($pinjaman as $data) {
            if(date("Y-m-d H:i:s") < $data->returned_at){
                $diff = date_diff(date_create($data->returned_at), date_create(date('Ymd')));
                $hasil = $diff->format('%d');
                echo $hasil . " => " . $data->buku->nama . "<br>";
            }
        }
    }
}
