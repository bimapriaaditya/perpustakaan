@extends('layouts.adminlte')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Pengguna Perpus Digi -- Laravel 7</h2>
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
            <h3 class="card-title">Profile List --</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($user as $data)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>
                        <form action="{{ route('user.destroy',$data->id) }}" method="POST">
        
                            <a class="btn btn-info" href="{{ route('user.show',$data->id) }}">Show</a>
            
                            <a class="btn btn-primary" href="{{ route('user.edit',$data->id) }}">Edit</a>
        
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
  
    {!! $user->links() !!}
      
@endsection