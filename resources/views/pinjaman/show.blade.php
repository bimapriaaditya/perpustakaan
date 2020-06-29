@php use App\Buku; @endphp
@extends('layouts.adminlte')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Peminjam : <i>{{$pinjaman->user->name}}</i></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pinjaman.index') }}">Back</a>
                @if($pinjaman->status !== 2)
                    <a class="btn btn-success" href="{{ route('pinjaman.edit',$pinjaman->id) }}">Return the Book</a>
                @endif
                </div>
        </div>
        <!-- Membuat Card Buku -->
        <div class="card-body">
            @php 
                $buku = Buku::with('author', 'penerbit')->where('id', $pinjaman->buku_id)->get();
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
                                        {{ Str::limit($data->deskripsi, 50)}}
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Penerbit : {{$data->penerbit->nama}}  </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Author : {{$data->author->nama}} </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{Storage::url('img/buku/' . $data->img)}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
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
        <!-- Akhir Card -->
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Buku </th>
                    <td>{{ $pinjaman->buku->nama }}</td>
                </tr>
                <tr>
                    <th> Peminjam </th>
                    <td>{{ $pinjaman->user->name }}</td>
                </tr>
                <tr>
                    <th> Total Pinjaman </th>
                    <td>{{ $pinjaman->quantity }} Unit</td>
                </tr>
                <tr>
                    <th> Tanggal Pinjam </th>
                    <td>{{ $pinjaman->created_at }}</td>
                </tr>
                <tr>
                    <th> Tanggal Kembali </th>
                    <td>{{ $pinjaman->returned_at }}</td>
                </tr>
                <tr>
                    <th>Buku Dikembalikan</th>
                    @if ($pinjaman->created_at == $pinjaman->updated_at)
                        <td style="color:red;">-</td>
                    @else
                        <td style="color:green;">{{ $pinjaman->updated_at }}</td>
                    @endif
                </tr>
                <tr>
                    <th> Status </th>
                    <td>{{ $pinjaman->status() }}</td>
                </tr>
            </table>   
        </div>
    </div>
@endsection