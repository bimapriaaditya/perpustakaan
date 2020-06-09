@php use App\Buku; @endphp
@extends('layouts.adminlte')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Stock Buku : <i>{{$stock->buku_id}}</i></h2>
            </div>
            <div class="pull-right">
                <form action="{{ route('stock.destroy',$stock->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('stock.index') }}">Back</a>
                    <a class="btn btn-success" href="{{ route('stock.edit',$stock->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Buku </th>
                    <td>{{ $stock->buku_id }}</td>
                </tr>
                <tr>
                    <th> Peminjam </th>
                    <td>{{ $stock->value }}</td>
                </tr>
            </table>   
        </div>
    </div>
@endsection