<?php

namespace App;

use App\Penerbit;
use App\Author;
use App\Pinjaman;
use App\Stock;
use App\RekapPinjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use RezaAr\Highcharts\Facade as Grafik;

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

    public function stock()
    {
        return $this->BelongsTo('App\Stock');
    }

    public function rekapbuku()
    {
        return $this->hasMany('App\RekapPinjaman');
    }

    public function deleteSampul()
    {
        $path = "img/buku/$this->img";
        return unlink($path);
    }

    public function getStock()
    {
        $stock = Stock::where('buku_id', $this->id)->value('value');
        if($stock > '5'){
            return $stock;
        }else{
            echo "<span style='color:red;'>" . "Stock Habis, Tidak Dapat di Pinjam 😜 " . "</span>";
        }
    }

    public function cekStock()
    {
        $stok = Stock::where('buku_id', $this->id)->value('value');
        
        if ( $stok > '5'){
            return true;
        }else{
            return false;
        }
    }

    public static function bestSeller()
    {
        $list = [];
        $month = date('m');
        $year = date('Y');
        $bests = RekapPinjaman::where(
            [
                ['bulan','=',$month],
                ['tahun','=',$year]
            ])
            ->orderBy('jumlah','desc')
            ->limit(5)
            ->get();
        foreach($bests as $best){
            $list[] = [
                'name' => $best->buku->nama,
                'data' => [$best->jumlah]
            ];
        }
        return $list;
    }

    public static function getGrafikBuku()
    {
        $bulan = date('M');
        return Grafik::title([
            'text' => "5 Buku Paling Favorite di bulan $bulan",
        ])
        ->chart([
            'type'     => 'column',
            'renderTo' => 'chart1', 
        ])
        ->subtitle([
            'text' => 'Rekomendasi buku berdasarkan peminjaman terbanyak',
        ])
        ->xAxis([
            'categories' =>
            [
                'Data Buku',
            ],
            'crosshair' => true
        ])
        ->yAxis([
            'title' =>
            [
                'text' => 'Pinjaman tercapai'
            ]
        ])
        ->legend([
            'enabled' => true,
        ])
        ->series(
            self::bestSeller()
        )
        ->display();
    }

}
