@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Atribut</h2>
            </div>
            <div class="pull-right">
                @can('atribut-create')
                <a class="btn btn-success" href="{{ route('atributs.create') }}"> Create New Atribut</a>
                @endcan
                @can('atribut-delete')
                <a class="btn btn-info" href="atributs/trash"> Deleted Atribut</a>
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
            <th>ID Atribut</th>
            <th>Nama Atribut</th>
        
            <th width="280px">Action</th>
        </tr>
        @foreach ($atributs as $atribut)
        <tr>
            <td>{{ $atribut->id_atribut }}</td>
            <td>{{ $atribut->nama_atribut }}</td>
            <td>
                <form action="{{ route('atributs.destroy',$atribut->id_atribut) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('atributs.show',$atribut->id_atribut) }}">Show</a>
                    @can('atribut-edit')
                    <a class="btn btn-primary" href="{{ route('atributs.edit',$atribut->id_atribut) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('atribut-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $atributs->links() !!}
   
@endsection

