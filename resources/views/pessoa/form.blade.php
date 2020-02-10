@extends('adminlte::page')

@section('title', 'Formulário de Pessoas')

@section('content_header')
    <h1>Formulário de Pessoas</h1>
@stop

@section('content')
{!! Form::open(['url' => route('fabricante.store')]) !!}
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome') !!}
    {!! Form::label('telefone', 'Telefone') !!}
    {!! Form::text('telefone') !!}
    {!! Form::label('email', 'Telefone') !!}
    {!! Form::text('telefone') !!}

    {!! Form::submit('Salvar') !!}
{!! Form::close() !!}
@stop

@section('css')
    
@stop

@section('js')
   
@stop