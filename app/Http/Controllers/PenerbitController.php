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
        $request->validate([
            'nama'=>'required',
        ]);

        Penerbit::create($request->all());

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
        $request->validate([
            'nama'=>'required',
        ]);

        $penerbit->update($request->all());

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
        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('Data berhasil dihapus');
    }
}
