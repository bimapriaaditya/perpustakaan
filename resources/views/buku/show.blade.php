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
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg-tambah">
                                Isi Stock
                            </button>
                        @else
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-lg-isi">
                                Isi Stock
                            </button>
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
    {{-- Modal large Isi Stok --}}
    <div class="modal fade" id="modal-lg-isi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stock Buku <b>{{ $buku->nama }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ action('StockController@store', $buku->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light" style="height: 300px;">
                                        <div class="card-header text-muted border-bottom-0">
                                            Informasi Buku :
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{$buku->nama}}</b></h2>
                                                    <p class="text-muted text-sm">
                                                        <b>Deskripsi: </b> 
                                                        {{ Str::limit($buku->deskripsi, 50)}}
                                                    </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Penerbit : {{$buku->penerbit->nama}}  </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Author : {{$buku->author->nama}} </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{Storage::url('img/buku/' . $buku->img)}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Nama Buku :') }}
                                        {{ Form::text('buku_id', $buku->nama, ['class' => 'form-control', 'readonly']) }}    
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Total Stock Buku :') }}
                                        {{ Form::text('value', null, ['class' => 'form-control']) }}                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        {{ Form::submit('Save data', ['class' => 'btn btn-success']) }}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- Modal large tambah Stok --}}
    <div class="modal fade" id="modal-lg-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stock Buku <b>{{ $buku->nama }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @php
                    $stock = Stock::where('buku_id', $buku->id)->first();
                @endphp
                <form action="{{ route('stock.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light" style="height: 300px;">
                                        <div class="card-header text-muted border-bottom-0">
                                            Informasi Buku :
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{$buku->nama}}</b></h2>
                                                    <p class="text-muted text-sm">
                                                        <b>Deskripsi: </b> 
                                                        {{ Str::limit($buku->deskripsi, 50)}}
                                                    </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Penerbit : {{$buku->penerbit->nama}}  </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Author : {{$buku->author->nama}} </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{Storage::url('img/buku/' . $buku->img)}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Nama Buku :') }}
                                        {{ Form::text('buku_id', $buku->nama, ['class' => 'form-control', 'readonly']) }}    
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Total Stock Buku :') }}
                                        {{ Form::number('value', $stock->value, ['class' => 'form-control']) }}                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        {{ Form::submit('Save data', ['class' => 'btn btn-success']) }}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection