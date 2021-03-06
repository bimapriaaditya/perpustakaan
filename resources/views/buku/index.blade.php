<?php 
use App\Buku;

?>

@extends('buku.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Buku Perpustakaan -- Laravel 7</h2>
            </div>
            <div class="pull-right">
                @auth
                    <a class="btn btn-success" href="{{ route('buku.create') }}"> Create New Book</a>
                @endauth
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div>&nbsp;</div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Buku --</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Penerbit</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Sampul Buku</th>
                    @if(Auth::Check())
                        <th width="280px">Action</th>
                    @else
                        <th width="280px" style="width: 80px;">Action</th>
                    @endif
                </tr>
                @foreach ($buku as $data)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->penerbit->nama }}</td>
                    <td>{{ $data->author->nama }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td><img src="{{ Storage::url('img/buku/'.$data->img) }}" alt="{{$data->img}}" width="100px" height="100px"></td>
                    @if(Auth::Check())
                        <td style="text-align:center;">
                            <form action="{{ route('buku.destroy',$data->id) }}" method="POST">
            
                                <a class="btn btn-info" href="{{ route('buku.show',$data->id) }}">Show</a>
                                    
                                <a class="btn btn-primary" href="{{ route('buku.edit',$data->id) }}">Edit</a>
            
                                @csrf
                                @method('DELETE')
                
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    @else
                        <td style="text-align:center;">
                            <a class="btn btn-info" href="{{ route('buku.show',$data->id) }}">Show</a>
                        </td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            <i class="fa fa-user"></i>
        </div>
    </div>
    <div id="chart1"></div>

    {!! Buku::getGrafikBuku() !!}
  
    {!! $buku->links() !!}
      
@endsection