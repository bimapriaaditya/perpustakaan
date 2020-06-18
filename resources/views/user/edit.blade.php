@extends('layouts.adminlte')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Data : </h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary">Back</a>
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

    <form action="{{route('user.update', $user->id)}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('name', 'Nama') }}
                    {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('email', 'E-Mail') }}
                    {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('name', 'Nama') }}
                    {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('img', 'Foto Profile') }} <br>
                    {{ Form::file('img')}}
                </div>
            </div>
            <!-- Submit -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {{ Form::submit('submit', ['class' => 'btn btn-primary']) }}   
                <div>&nbsp;</div>
            </div>
        </div>
    </form>
@endsection