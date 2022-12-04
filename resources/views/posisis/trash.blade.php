@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted posisis</h2>
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
            <th>ID posisi</th>
            <th>Nama posisi</th>
    
            <th width="280px">Action</th>
        </tr>
        @foreach ($posisis as $posisi)
        <tr>
            <td>{{ $posisi->id_posisi }}</td>
            <td>{{ $posisi->nama_posisi }}</td>
          
            <td>
                    <a class="btn btn-info" href="trash/{{ $posisi->id_posisi }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $posisi->id_posisi }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $posisis->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection