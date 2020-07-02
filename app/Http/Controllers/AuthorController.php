<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'show'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::latest()->paginate(10);

        return view('author.index', compact('author'))
            ->with('i', (request()->input('page',1) -1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $author->nama = $request->input('nama');
        $author->deskripsi = $request->input('deskripsi');

        $img = $request->file('img');
        $imgName = date('Ymdhis') . '_' . $request->input('nama') . '.' . $img->getClientOriginalExtension();
        $author->img = $imgName;
        $img->move(public_path('img/author'), $imgName);
           
        $author->save();

        return redirect()->route('author.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'img' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        $old_profile = $author->img;

        $author->nama = $request->input('nama');
        $author->deskripsi = $request->input('deskripsi');

        $img = $request->file('img');
        if ($img !== null){
            $imgName = date('Ymdhis') . '_' . $request->input('nama') . '.' . $img->getClientOriginalExtension();
            $author->img = $imgName;
            $img->move(public_path('img/author'),$imgName);
        }else{
            $author->img = $old_profile;
        }

        $author->save();

        return redirect()->route('author.show', $author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        $author->deletePhoto();
        return redirect()->route('author.index');
    }
}
