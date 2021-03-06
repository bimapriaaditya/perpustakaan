<?php

namespace App\Http\Controllers;

use App\Pinjaman;
use App\Buku;
use App\Penerbit;
use App\Stock;
use App\RekapPinjaman;
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
            'quantity' => 'required|numeric|max:5|min:1'
        ]);

        $pinjaman->buku_id = $request->input('buku_id');
        $pinjaman->user_id = auth()->user()->id;
        $pinjaman->quantity = $request->input('quantity');
        $pinjaman->status = 1;
        $pinjaman->returned_at = date("Y-m-d H:i:s", strtotime("+7 days"));

        $cek = RekapPinjaman::where([
            ['buku_id', '=', $pinjaman->buku_id],
            ['tahun', '=', date('Y')],
            ['bulan', '=', date('m')]
        ])->exists();

        if($pinjaman->save()){
            Stock::where('buku_id', $request->input('buku_id'))->decrement('value', $request->input('quantity'));
            
            if( $cek ){
                RekapPinjaman::where([
                    ['buku_id', '=', $pinjaman->buku_id],
                    ['tahun', '=', date('Y')],
                    ['bulan', '=', date('m')]
                ])->increment('jumlah', 1);
            }else{
                RekapPinjaman::create([
                    'buku_id' => $pinjaman->buku_id,
                    'tahun' => date('Y'),
                    'bulan' => date('m'),
                    'jumlah' => 1
                ]);
            }
        }

        return redirect()->route('pinjaman.show', [$pinjaman->id]);

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
        $pinjaman_max = $pinjaman->quantity;
        $request->validate([
            "buku_id" => "required",
            "quantity" => "required|numeric|max:$pinjaman_max|min:1"
        ]);
        
        $pinjaman->buku_id = $request->input('buku_id');
        $pinjaman->user_id = auth()->user()->id;
        $pinjaman->quantity = $request->input('quantity');
        $pinjaman->status = 2;

        if ($pinjaman->save()){
            Stock::where('buku_id', $request->input('buku_id'))->increment('value', $request->input('quantity'));
        }
        
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
