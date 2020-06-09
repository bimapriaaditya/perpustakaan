@php use App\Buku; @endphp
@extends('layouts.adminlte')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Stock Buku</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('stock.index') }}"> Back</a>
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
   
<form action="{{ route('stock.store') }}" method="POST">
    @csrf
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('buku_id', 'Buku : ') }}
                {{ Form::text('buku_id', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('value', 'Jumlah Stock :') }} <br>
                {{ Form::number('value', 'null', ['class' => 'form-control', 'placeholder' => 'Jumlah Stock']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}   
            <div>&nbsp;</div>
        </div>
    </div>
   
</form>
@endsection