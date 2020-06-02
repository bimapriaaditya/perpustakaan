@php use App\Buku @endphp
@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Penerbit : <i>{{$penerbit->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penerbit.index') }}"> Back</a>
                <a class="btn btn-success" href="{{ route('penerbit.edit',$penerbit->id) }}"> Edit </a>
                <a class="btn btn-danger" href="{{ route('penerbit.destroy',$penerbit->id) }}"> Delete</a>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Nama Penerbit  </th>
                    <td>{{ $penerbit->nama }}</td>
                </tr>
            </table>   
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
                $buku = Buku::with('author', 'penerbit')->where('penerbit_id',$penerbit->id)->get();
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
                                    <img src="" alt="Foto">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm btn-primary">
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