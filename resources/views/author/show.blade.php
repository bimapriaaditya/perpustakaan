@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books <i>{{$author->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('author.index') }}"> Back</a>
                <a class="btn btn-success" href="{{ route('author.edit',$author->id) }}"> Edit </a>
                <a class="btn btn-danger" href="{{ route('author.destroy',$author->id) }}"> Delete</a>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Nama </th>
                    <td>{{ $author->nama }}</td>
                </tr>
                <tr>
                    <th> Deskripsi Buku </th>
                    <td>{{ $author->deskripsi }}</td>
                </tr>
            </table>   
        </div>
    </div>
@endsection