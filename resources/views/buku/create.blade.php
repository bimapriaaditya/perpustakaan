@extends('buku.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Books</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('buku.index') }}"> Back</a>
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
   
<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Buku:</strong>
                <input type="text" name="nama" class="form-control" placeholder="Nama">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::Label('penerbit', 'Penerbit : ') !!}
                {!! Form::select('penerbit_id', $items_penerbit, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::Label('author', 'Author / Penulis : ') }}
                {{ Form::Select('author_id', $items_author, null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('deskripsi', 'Deskripsi : ') }}
                {{ Form::textarea('deskripsi', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div>
            {{ Form::label('img', 'Sampul Buku : ') }} <br>
            {{ Form::file('img') }}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{Form::submit('submit', ['class' => 'btn btn-primary'])}}
        </div>
    </div>
   
</form>
@endsection