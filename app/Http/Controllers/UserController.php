<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->paginate(20);

        return view('user.index', compact('user'))
            ->with('i',(request()->input('page','1') -1) * 20);
    }

    public function userIndex()
    {
        $user = User::latest();
        
        return view('user.userIndex',[
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function profil()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $fotoLama = $user->img;
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $img = $request->file('img');
        if ($img !== null ){
            $imgName = 'Profile_' . $request->input('name') . '_' . date('Ymdhis') . '.' . $img->getClientOriginalExtension();
            $user->img = $imgName;
            $img->move(public_path('img/user'), $imgName);
        }else{
            $user->img = $fotoLama;
        }
        
        $user->save();

        return redirect()->route('user.show', [$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->deletePicture();
        $user->delete();   

        return redirect()->route('user.index');
    }
}
