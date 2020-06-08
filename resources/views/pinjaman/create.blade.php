@extends('layouts.adminlte')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Data</h2>
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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('buku_id', 'Buku Pinjaman : ') }}
                {{ Form::text('buku_id', $buku_id, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('user_id', 'Peminjam : ') }}
                {{ Form::textarea('user_id', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div>
            {{ Form::label('quantity', 'Jumlah Pinjaman :') }} <br>
            {{ Form::number('quantity', 'null', ['class' => 'form-control']) }}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}   
        </div>
    </div>
   
</form>
@endsection