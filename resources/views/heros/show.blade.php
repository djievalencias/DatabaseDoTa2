@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Hero</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('heros.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Hero:</strong>
                {{ $hero->id_hero }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Hero:</strong>
                {{ $hero->nama_hero }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Atribut:</strong>
                {{ $hero->id_atribut }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Posisi:</strong>
                {{ $hero->id_posisi }}
            </div>
        </div>
    </div>
@endsection
<p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>

