<?php 
use App\Pinjaman;
use App\Stock;
?>
@extends('buku.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books <i>{{$buku->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <form action="{{ route('buku.destroy',$buku->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('buku.index') }}">Back</a>
                    @auth
                        @if(Auth()->user()->role == 2)
                            <a class="btn btn-success" href="{{ route('buku.edit',$buku->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endif
                    @endauth
                </form>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
   <div class="card card-primary">
        <div class="card-header">
           <h2 class = "card-title"> {{$buku->nama}} </h2>
       </div>
       <div class="card-body">
            <div class="row">
                @auth
                    @if(Auth()->user()->role == 2)
                        <?php
                        $stok = Stock::where('buku_id', $buku->id)->value('id');
                        ?>
                        @if($stok == true)
                            <a href="{{ route('stock.edit', $stok) }}" class="btn btn-primary btn-sm">Tambah Stok</a>
                        @else
                            <a href="{{ action('StockController@create', $buku->id) }}" class="btn btn-success btn-sm">Isi Stok</a>
                        @endif
                    @endif
                @endauth
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th> Nama Buku </th>
                            <td><?= $buku->nama ?></td>
                        </tr>
                        <tr>
                            <th> Penerbit </th>
                            <td> <a href="{{ route('penerbit.show',$buku->penerbit_id) }}">
                                    <?= $buku->penerbit->nama ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th> Penulis </th>
                            <td>
                                <a href="{{ route('author.show', $buku->author_id) }}">
                                <?= $buku->author->nama ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th> Deskripsi Buku </th>
                            <td><?= $buku->deskripsi ?></td>
                        </tr>
                        <tr>
                            <th> Stok Buku </th>
                            <td> {{ $buku->getStock() }} </td>
                        </tr>
                        <tr>
                            <th> Sampul Buku </th>
                            <td>
                                <img src="{{ Storage::url('img/buku/'.$buku->img) }}" alt="{{$buku->img}}" width="200px" height="200px">
                            </td>
                        </tr>
                    </table>   
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: right;" >
        @auth
            @if($buku->cekStock() == true)
                <a href="{{action('PinjamanController@create', $buku->id) }}" class="btn btn-danger">Pinjam Buku</a>
            @endif
        @endauth
        <div>&nbsp;</div>
    </div>
    <center>
        <div class="card card-outline card-success" style="width: 80%; text-align:center;">
            <div class="card-header">
                <h3 class="card-title">Histori Peminjam Buku</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Total Pinjaman</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @php 
                    $no = 1;
                    $histori = Pinjaman::with('user')->where('buku_id', $buku->id)->get(); 
                @endphp
                @foreach($histori as $data)
                <tbody>
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->UpdateAt() }}</td>
                        <td>{{ $data->status() }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            </div>
        </div>
    </center>
    <div>&nbsp;</div>
@endsection