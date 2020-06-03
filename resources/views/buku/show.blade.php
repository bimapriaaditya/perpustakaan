@extends('buku.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Books <i>{{$buku->nama}}</i></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('buku.index') }}"> Back</a>
                <a class="btn btn-success" href="{{ route('buku.edit',$buku->id) }}"> Edit </a>
                <a class="btn btn-danger" href="{{ route('buku.destroy',$buku->id) }}"> Delete</a>
            </div>
        </div>
    </div>
   <div>&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th> Nama Buku </th>
                    <td><?= $buku->nama ?></td>
                </tr>
                <tr>
                    <th> Penerbit </th>
                    <td> <a href="{{ route('penerbit.show',$buku->penerbit_id) }}">
                            <?= $buku->penerbit->nama ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th> Penulis </th>
                    <td>
                        <a href="{{ route('author.show', $buku->author_id) }}">
                        <?= $buku->author->nama ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th> Deskripsi Buku </th>
                    <td><?= $buku->deskripsi ?></td>
                </tr>
                <tr>
                    <th> Sampul Buku </th>
                    <td>
                        <img src="/img/buku/{{$buku->img}}" alt="{{$buku->img}}" width="200px" height="200px">
                    </td>
                </tr>
            </table>   
        </div>
    </div>
@endsection