<?php

namespace App\Http\Controllers;

use App\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerbit = Penerbit::latest()->paginate(20);

        return view('penerbit.index', compact('penerbit'))
            ->with('i', (request()->input('page',1)-1)*20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penerbit = new Penerbit();

        $request->validate([
            'nama'=>'required',
            'deskripsi'=>'required',
            'img'=>'required|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        $penerbit->nama = $request->input('nama');
        $penerbit->deskripsi = $request->input('deskripsi'); 

        $img = $request->file('img');
        $imgName = date('Ymdhis') . '_' . $request->input('nama') . '.' . $img->getClientOriginalExtension();
        $penerbit->img = $imgName;

        if ($penerbit->save()){
            $img->move(public_path('img/penerbit'), $imgName);
        }

        return redirect()->route('penerbit.index')
            ->with('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        return view('penerbit.show',compact('penerbit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerbit $penerbit)
    {
        return view('penerbit.edit',compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $logo_lama = $penerbit->img;

        $request->validate([
            'nama'=>'required',
            'deskripsi'=>'required',
        ]);

        $penerbit->nama = $request->input('nama');
        $penerbit->deskripsi = $request->input('deskripsi');

        $img = $request->file('img');
        if ($img !== null){
            $imgName = date('Ymdhis') . '_' . $request->input('nama') . '.' . $img->getClientOriginalExtension();
            $penerbit->img = $imgName;
            $img->move(public_path('img/penerbit'), $imgName);
        }else{
            $penerbit->img = $logo_lama;
        }

        $penerbit->save();

        return redirect()->route('penerbit.show', $penerbit)
            ->with('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit)
    {
        $penerbit->deletePhoto();
        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('Data berhasil dihapus');
    }
}
