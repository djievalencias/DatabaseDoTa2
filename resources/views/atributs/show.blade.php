@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Atribut</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('atributs.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Atribut:</strong>
                {{ $atribut->id_atribut }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Atribut:</strong>
                {{ $atribut->nama_atribut }}
            </div>
        </div>
        
    </div>
@endsection
<p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>

