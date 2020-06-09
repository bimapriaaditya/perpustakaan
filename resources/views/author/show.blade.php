@php use App\Buku @endphp
@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Author : <i>{{$author->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <form action="{{ route('author.destroy',$author->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('author.index') }}">Back</a>
                    <a class="btn btn-success" href="{{ route('author.edit',$author->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
   <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">
                Data Diri
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th> Nama </th>
                            <td>{{ $author->nama }}</td>
                        </tr>
                        <tr>
                            <th> Deskripsi Diri </th>
                            <td>{{ $author->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th> Profile Picture </th>
                            <td> <img src="/img/author/{{$author->img}}" alt="{{ $author->img }}" height="200px" width="200px"> </td>
                        </tr>
                    </table>   
                </div>
            </div>
        </div>
    </div>
    <div class="card card-success">
        <div class="card-header">
            <h4 class="card-title">
                Karya lainnya
            </h4>
        </div>
        <div class="card-body">
            @php 
                $buku = Buku::with('penerbit', 'author')->where('author_id',$author->id)->get()
            @endphp
            <div class="row">
            @foreach ($buku as $data)
                <div class="col-md-4 d-fluid">
                    <div class="card bg-light" style="height: 300px;">
                        <div class="card-header text-muted border-bottom-0">
                            Informasi Buku :
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$data->nama}}</b></h2>
                                    
                                    <p class="text-muted text-sm">
                                        <b>Deskripsi: </b> 
                                        @php
                                        $value = $data->deskripsi;
                                        echo Str::limit($value, 50);
                                        @endphp
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Penerbit : {{$data->penerbit->nama}}  </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Author : {{$data->author->nama}} </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="/img/buku/{{$data->img}}" alt="{{$data->img}}" width="100px" height="100px" style="border-radius:10px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="{{ route('buku.show', $data->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-book"></i> Lihat Buku
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
   </div>
    
@endsection