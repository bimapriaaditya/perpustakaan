@php Use App\Buku; @endphp
@extends('layouts.adminlte')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Data</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('stock.show', $stock->id) }}"> Back</a>
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
  
    <form action="{{ route('stock.update',$stock->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('value', 'Jumlah Stock :') }} <br>
                    {{ Form::number('value', $stock->quantity, ['class' => 'form-control', 'placeholder' => 'Jumlah stock']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('buku_id', 'Nama Buku :') }}
                    {{ Form::text('buku_id', $stock->buku_id, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}   
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
   
    </form>
@endsection