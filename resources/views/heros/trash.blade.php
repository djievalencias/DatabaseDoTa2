@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Heros</h2>
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
            <th>ID posisi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($heros as $hero)
        <tr>
            <td>{{ $hero->id_hero }}</td>
            <td>{{ $hero->nama_hero }}</td>
            <td>{{ $hero->id_atribut }}</td>
            <td>{{ $hero->id_posisi }}</td>
            <td>
                    <a class="btn btn-info" href="trash/{{ $hero->id_hero }}/restore">Restore</a>
                    <a class="btn btn-danger" onclick="return confirm('beneran yakin?')" href="trash/{{ $hero->id_hero }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $heros->links() !!}
    
@endsection