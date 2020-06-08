<?php

namespace App\Http\Controllers;

use App\Pinjaman;
use App\Buku;
use App\Penerbit;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjaman = Pinjaman::latest()->paginate(20);
        
        return view('pinjaman.index', compact('pinjaman'))
            ->with('i', (request()->input('page','1') -1) *20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($buku_id)
    {
        return view('pinjaman.create', compact('buku_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pinjaman = new Pinjaman();
        
        $request->validate([
            'buku_id' => 'required',
            'quantity' => 'required'
        ]);

        $pinjaman->buku_id = $request->input('buku_id');
        $pinjaman->user_id = auth()->user()->id;
        $pinjaman->quantity = $request->input('quantity');

        $pinjaman->save();
        //Pinjaman::create($request->all());

        return redirect()->route('pinjaman.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        return view('pinjaman.show', compact('pinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        return view('pinjaman.edit', compact('pinjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'buku_id' => 'required',
            'user_id' => 'required', 
            'quantity' => 'required'
        ]);

        $pinjaman->update($request->all());

        return redirect()->route('pinjaman.show', compact('pinjaman'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();

        return redirect()->route('pinjaman.index');
    }
}
