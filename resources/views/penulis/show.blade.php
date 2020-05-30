@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books <i>{{$penulis->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penulis.index') }}"> Back</a>
                <a class="btn btn-success" href="{{ route('penulis.edit',$penulis->id) }}"> Edit </a>
                <a class="btn btn-danger" href="{{ route('penulis.destroy',$penulis->id) }}"> Delete</a>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Nama Penulis  </th>
                    <td>{{ $penulis->nama }}</td>
                </tr>
            </table>   
        </div>
    </div>
@endsection