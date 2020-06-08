@php use App\Buku; @endphp
@extends('layouts.adminlte')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Pinjam Buku</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('pinjaman.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ action('PinjamanController@store') }}" method="POST">
    @csrf
  
    <div class="row">
        <!-- Membuat Card Buku -->
        <div class="card-body">
            @php 
                $buku = Buku::with('author', 'penerbit')->where('id', $buku_id)->get();
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
                                    <img src="/img/buku/{{$data->img}}" alt="Foto" width="125px" height="125px" style="border-radius: 10px;" >
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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('quantity', 'Jumlah Pinjaman :') }} <br>
                {{ Form::number('quantity', 'null', ['class' => 'form-control', 'placeholder' => 'Jumlah Buku']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::hidden('buku_id', $buku_id, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::hidden('user_id', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}   
            <div>&nbsp;</div>
        </div>
    </div>
   
</form>
@endsection