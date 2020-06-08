@extends('layouts.adminlte')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Peminjam Buku Perpusatakaan -- Laravel 7</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pinjaman.create') }}"> Buat Pinjaman</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div>&nbsp;</div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Pinjaman --</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Peminjam</th>
                    <th>Total</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($pinjaman as $data)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data->buku->nama }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>
                        <form action="{{ route('pinjaman.destroy',$data->id) }}" method="POST">
        
                            <a class="btn btn-info" href="{{ route('pinjaman.show',$data->id) }}">Show</a>
            
                            <a class="btn btn-primary" href="{{ route('pinjaman.edit',$data->id) }}">Edit</a>
        
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            Footer
        </div>
    </div>
  
    {!! $pinjaman->links() !!}
      
@endsection