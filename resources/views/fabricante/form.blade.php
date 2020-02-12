@extends('adminlte::page')

@section('title', 'Formulário de Fabricantes')

@section('content_header')
    <h1>Formulário de Fabricantes</h1>
@stop

@section('content')

    @if(isset($fabricante))
        {!! Form::model($fabricante, ['method' => 'put', 'route' => ['fabricante.update', $fabricante->id]]) !!}
        
    @else
        {!! Form::open(['url' => route('fabricante.store')]) !!}
    @endif
    @csrf
            {!! Form::label('nome', 'Nome Fabricante') !!}
            {!! Form::text('nome') !!}

            {!! Form::label('site', 'Site Fabricante') !!}
            {!! Form::text('site') !!}
            <br>
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}

@stop

@section('css')
    
@stop

@section('js')
   
@stop