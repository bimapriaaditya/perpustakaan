<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Penerbit;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::latest()->paginate(10);

        $chart1 = \Chart::title([
            'text' => 'Voting ballon d`or 2018',
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'This Subtitle',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner',
                'Julian Casablancas',
                'Bambang Pamungkas',
                'Mbah Surip',
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
                // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658],
                    // 'color' => '#0c2959',
                ],
            ]
        )
        ->display();

        return view('buku.index', compact('buku'), ['chart1' => $chart1])
            ->with('i', (request()->input('page',1) -1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items_penerbit = Penerbit::pluck('nama', 'id');
        $items_author = Author::pluck('nama', 'id');
        return view('buku.create', compact('id', 'items_penerbit', 'items_author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Buku(); 

        $request->validate([
            'nama' => 'required',
            'penerbit_id' => 'required',
            'author_id' => 'required',
            'deskripsi' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $model->nama = $request->input('nama');
        $model->penerbit_id = $request->input('penerbit_id');
        $model->author_id = $request->input('author_id');
        $model->deskripsi = $request->input('deskripsi');

        $img = $request->file('img');
        $imgName = date('Ymdhis') . '_' . 'Profile Book' . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('img/buku'), $imgName);
        $model->img = $imgName;
           
        $model->save();

        return redirect()->route('buku.index')
            ->with('Penyimpanan berhasil, Buku telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        $items_penerbit = Penerbit::pluck('nama', 'id');
        $items_author = Author::pluck('nama', 'id');

        return view('buku.edit',compact('buku', 'items_penerbit', 'items_author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'nama' => 'required',
            'penerbit_id' => 'required',
            'author_id' => 'required',
            'deskripsi' => 'required',
        ]);

        $sampul_lama = $buku->img;

        $buku->nama = $request->input('nama');
        $buku->penerbit_id = $request->input('penerbit_id');
        $buku->author_id = $request->input('author_id');
        $buku->deskripsi = $request->input('deskripsi');

        $img = $request->file('img');
        if($img !== null){
            $imgName = date('Ymdhis') . '.' . 'Profile Book' . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('img/buku'), $imgName);
            $buku->img = $imgName;
        } else {
            $buku->img = $sampul_lama;
        }

        $buku->save();

        return redirect()->route('buku.show', [$buku])
            ->with('Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        $buku->deleteSampul();
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('Data berhasil dihapus');
    }

}
