<?php

namespace App\Http\Controllers;

use App\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penulis = Penulis::latest()->paginate(20);

        return view('penulis.index', compact('penulis'))
            ->with('i', (request()->input('page',1)-1)*20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penulis.create');
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
            'nama'=>'required',
        ]);

        Penulis::create($request->all());

        return redirect()->route('penulis.index')
            ->with('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penulis $penulis)
    {
        return view('penulis.show',compact('penulis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penulis $penulis)
    {
        return view('penulis.edit',compact('penulis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penulis $penulis)
    {
        $request->validate([
            'nama'=>'required',
        ]);

        $penulis->update($request->all());

        return redirect()->route('penulis.index')
            ->with('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penulis $penulis)
    {
        $penulis->delete();

        return redirect()->route('penulis.index')
            ->with('Data berhasil dihapus');
    }
}
