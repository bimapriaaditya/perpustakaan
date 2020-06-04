@extends('layouts.adminlte')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Data</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('author.show', $author->id) }}"> Back</a>
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
  
    <form action="{{ route('author.update',$author->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('nama', 'Nama Penulis / Author') }}
                    {{ Form::text('nama', $author->nama, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('deskripsi', 'Deskripsi : ') }}
                    {{ Form::textarea('deskripsi', $author->deskripsi, ['class' => 'form-control']) }}
                </div>
            </div>
            <div>
                {{ Form::label('deskripsi', 'Profile Picture : ') }}
                {{ Form::file('img') }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
   
    </form>
@endsection