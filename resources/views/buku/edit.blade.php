@extends('buku.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
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
  
    <form action="{{ route('buku.update',$buku->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('nama', 'Judul Buku : ')}}
                    {{ Form::text('nama', $buku->nama, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('penerbit_id', 'Penerbit : ') }}
                    {{ Form::select('penerbit_id', $items_penerbit, $buku->penerbit_id, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('author', 'Penulis / Author : ') }}
                    {{ Form::Select('author_id', $items_author, $buku->author_id, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::Label('author', 'Deskripsi Buku : ') }}
                    {{ Form::textarea('deskripsi', $buku->deskripsi, array('class' => 'form-control')) }}    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <?= Form::submit('submit', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
   
    </form>
@endsection