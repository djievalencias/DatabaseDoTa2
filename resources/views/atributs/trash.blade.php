@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Atributs</h2>
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
                    <a class="btn btn-info" href="trash/{{ $atribut->id_atribut }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $atribut->id_atribut }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $atributs->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection