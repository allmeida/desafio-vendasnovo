@extends('adminlte::page')

@section('title', 'Formulário de Pessoas')

@section('content_header')
    <h1>Formulário de Pessoas</h1>
@stop

@section('content')
<div class="box box-primary">
    @if(isset($pessoa))
    {!! Form::model($pessoa, ['method' => 'put', 'route' => ['pessoa.update', $pessoa->id]]) !!}

    @else
    {!! Form::open(['url' => route('pessoa.store')]) !!}
    @endif
    @csrf
        <div class="box-body">
            <div class="form-goup">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome') !!}
            </div>
            <div class="form-goup">
                {!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone') !!}
            </div>
            <div class="form-goup">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email') !!}
            </div>
            <div class="form-goup">
                {!! Form::label('cep', 'Cep') !!}
                {!! Form::text('cep') !!}
            </div>
            <div class="form-group">
                {!! Form::label('logradouro', 'Logradouro') !!}
                {!! Form::text('logradouro') !!}
            </div>
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro') !!}
            </div>            
            <div class="form-group">
                {!! Form::label('localidade', 'Localidade') !!}
                {!! Form::text('localidade') !!}
            </div>
            <div class="form-goup">
                {!! Form::label('grupo', 'Grupo') !!}
                {!! Form::number('grupo') !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Salvar') !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@stop

@section('css')
    
@stop

@section('js')
   
@stop