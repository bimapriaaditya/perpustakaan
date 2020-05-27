@extends('buku.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 7 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('buku.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Buku</th>
            <th>Penerbit</th>
            <th>Penulis</th>
            <th>Deskripsi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($buku as $data)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->penulis }}</td>
            <td>{{ $data->penerbit }}</td>
            <td>{{ $data->deskripsi }}</td>
            <td>
                <form action="{{ route('buku.destroy',$data->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('buku.show',$data->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('buku.edit',$data->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $buku->links() !!}
      
@endsection