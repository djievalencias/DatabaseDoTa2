@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Heros</h2>
            </div>
            <div class="pull-right">
                @can('hero-create')
                <a class="btn btn-success" href="{{ route('heros.create') }}"> Create New Hero</a>
                @endcan
                @can('hero-delete')
                <a class="btn btn-info" href="heros/trash"> Deleted Hero</a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
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
            <th>ID Hero</th>
            <th>Nama Hero</th>
            <th>ID Atribut</th>
            <th>ID Posisi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($heros as $hero)
        <tr>
            <td>{{ $hero->id_hero }}</td>
            <td>{{ $hero->nama_hero }}</td>
            <td>{{ $hero->id_atribut }}</td>
            <td>{{ $hero->id_posisi }}</td>
            <td>
                <form action="{{ route('heros.destroy',$hero->id_hero) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('heros.show',$hero->id_hero) }}">Show</a>
                    @can('hero-edit')
                    <a class="btn btn-primary" href="{{ route('heros.edit',$hero->id_hero) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('hero-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $heros->links() !!}
    
@endsection

