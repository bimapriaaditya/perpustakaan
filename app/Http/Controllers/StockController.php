<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::latest()->paginate(10);

        return view('stock.index', compact('stock'))
            ->with('i', (request()->input('page',1)-1)*10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $buku_id)
    {
        $stock = new Stock();

        $request->validate([
            'value'
        ]);

        $stock->buku_id = $buku_id;
        $stock->value = $request->input('value');

        $stock->save();

        return redirect()->route('buku.show', [$buku_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('stock.show',compact('stock'));
    }

    public function showBook(Stock $buku_id)
    {
        return view('stock.show',compact('buku_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'buku_id', 'value'
        ]);
        
        $stock->value = $request->input('value');

        $stock->save();

        return redirect()->route('buku.show', [$stock->buku_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stock.index');
    }
}
