<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Penerbit;
use App\Author;
use Illuminate\Http\Request;

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

        return view('buku.index', compact('buku'))
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
        $request->validate([
            'nama' => 'required',
            'id_penerbit' => 'required',
            'id_author' => 'required',
            'deskripsi' => 'required',
        ]);

        Buku::create($request->all());

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
        return view('buku.edit',compact('buku'));
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
            'id_penerbit' => 'required',
            'id_author' => 'required',
            'deskripsi' => 'required',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
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
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('Data berhasil dihapus');
    }

}
