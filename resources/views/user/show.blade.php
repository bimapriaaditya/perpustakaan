<?php 
use App\Pinjaman; 
?>
@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> User : <i>{{$user->name}}</i></h2>
            </div>
            <div class="pull-right">
                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('user.index') }}">Back</a>
                    <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Data Pengguna </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th> ID Akun </th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th> Nama </th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th> Alamat Email </th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th> Dibuat Pada </th>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    </table>  
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"> Pinjaman Ku </h3>
                </div>
                <div class="card-body">
                    <?php 
                    $pinjaman = Pinjaman::where(
                        [
                            ['user_id', '=' ,$user->id],
                            ['status', '=', '1']
                        ])
                    ->get();
                    ?>
                    <div class="row">
                        @foreach($pinjaman as $data)
                        <div class="col-sm-4">
                            <div class="card bg-light" style="height: 300px;">
                                <div class="card-header border-bottom-0">
                                    Jumlah Pinjaman : {{ $data->quantity }}
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{$data->buku->nama}}</b></h2>
                                            <p class="text-muted text-sm">
                                                <b>Deskripsi: </b> 
                                                {{ Str::limit($data->buku->deskripsi, 50)}}
                                            </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Penerbit : {{$data->buku->penerbit->nama}}  </li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Author : {{$data->buku->author->nama}} </li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="/img/buku/{{$data->buku->img}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('buku.show', $data->buku->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-book"></i> Lihat Buku
                                        </a>
                                        <a href="{{ route('pinjaman.show', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-redo"></i> Kembalikan Buku
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"> Histori Peminjaman </h3>
                </div>
                <div class="card-body">
                    <?php 
                    $no = 1;
                    $histori = Pinjaman::where('user_id', $user->id)->orderBy('id', 'desc')->get();
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Judul Buku </th>
                                <th> Tanggal Pinjam </th>
                                <th> Tanggal Kembali </th>
                                <th> Jumlah Pinjaman </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histori as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->buku->nama }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    @if ($data->created_at == $data->updated_at)
                                        <td style="color:red;">-</td>
                                    @else
                                        <td style="color:green;">{{ $data->updated_at }}</td>
                                    @endif
                                    <td>{{ $data->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection