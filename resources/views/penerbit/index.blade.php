@extends('layouts.adminlte')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Penerbit Perpustakaan -- Laravel 7</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('penerbit.create') }}"> Create New Book</a>
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
            <h3 class="card-title">List Penerbit --</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($penerbit as $data)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>
                        <form action="{{ route('penerbit.destroy',$data->id) }}" method="POST">
        
                            <a class="btn btn-info" href="{{ route('penerbit.show',$data->id) }}">Show</a>
            
                            <a class="btn btn-primary" href="{{ route('penerbit.edit',$data->id) }}">Edit</a>
        
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
  
    {!! $penerbit->links() !!}
      
@endsection