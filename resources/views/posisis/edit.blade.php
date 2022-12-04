@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Posisi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posisis.index') }}"> Back</a>
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
    <form action="{{ route('posisis.update',$posisi->id_posisi) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Posisi:</strong>
                    <input type="number" name="id_posisi" value="{{ $posisi->id_posisi }}" class="form-control" placeholder="ID Posisi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Posisi:</strong>
                    <input type="text" name="nama_posisi" value="{{ $posisi->nama_posisi }}" class="form-control" placeholder="Name">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection


