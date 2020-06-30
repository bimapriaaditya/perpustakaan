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
    <!-- Query -->
    <?php 
        $pinjaman = Pinjaman::where(
            [
                ['user_id', '=', $user->id],
                ['status', '=', '1'],
            ]
        )->get();

        $sekarang = date('Y-m-d');
    ?>
    <!-- If Approaching exp -->
    @foreach($pinjaman as $data)
        <?php
            $expDay = date('Y-m-d', strtotime($data->returned_at));
            $diff = date_diff(date_create($sekarang), date_create($data->returned_at));
            $hasil = $diff->format('%d');
        ?>
        @if($sekarang < $expDay && $hasil <= 3)
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Alert!</h5>
                Buku <b> {{$data->buku->nama}} </b> harus segera dikembalikan dalam
                <b>{{$hasil}} Hari .</b>
            </div>
        @endif
    @endforeach
    <!-- end of Approaching exp -->

    <!-- if on exp day -->
    @foreach($pinjaman as $data)
        <?php
            $expDay = date('Y-m-d', strtotime($data->returned_at));
        ?>
        @if($sekarang == $expDay)
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                Buku <b> {{$data->buku->nama}} </b> harus segera dikembalikan
                <b>Hari ini !!!</b>
            </div>
        @endif
    @endforeach
    <!-- end of on exp day -->

    <!-- If expired -->
    @foreach($pinjaman as $data)
        <?php
            $expDay = date('Y-m-d', strtotime($data->returned_at));
            $diff = date_diff(date_create($sekarang), date_create($expDay));
            $hari = $diff->format('%d');
            $harga = $hari * 500;
            $denda = number_format($harga);
        ?>
        @if($sekarang > $expDay)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Buku <b> {{$data->buku->nama}} </b> terlambat dikembalikan
                <b>- {{$hari}} hari. Denda Rp. {{$denda}}</b>
            </div>
        @endif
    @endforeach
    <!-- end Expired -->
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
                        <tr>
                            <th> Photo Profile </th>
                            <td><img src="{{Storage::url('img/user/' . $user->img)}}" alt="{{$user->img}}" style="width:250px; height:250px;"></td>
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
                                            <img src="{{Storage::url('img/buku/' . $data->buku->img)}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('buku.show', $data->buku->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-book"></i> Lihat Buku
                                        </a>
                                        @if($user->id == auth()->user()->id)
                                            <a href="{{ route('pinjaman.show', $data->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-redo"></i> Kembalikan Buku
                                            </a>
                                        @endif
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