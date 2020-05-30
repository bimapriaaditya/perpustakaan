@extends('layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books <i>{{$penerbit->nama}}</i></h2>
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
@endsection