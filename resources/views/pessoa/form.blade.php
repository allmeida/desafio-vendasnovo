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
            
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome') !!}
            
                {!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone') !!}
            
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email') !!}
                
                {!! Form::label('cep', 'Cep') !!}
                {!! Form::text('cep')"!!}
            
                {!! Form::label('logradouro', 'Logradouro') !!}
                {!! Form::text('logradouro') !!}
            
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro') !!}
                
                {!! Form::label('localidade', 'Localidade') !!}
                {!! Form::text('localidade') !!}
            
                {!! Form::label('grupo', 'Grupo') !!}
                {!! Form::number('grupo') !!}
                <br>
                {!! Form::submit('Salvar') !!}
            
        </div>
    {!! Form::close() !!}
</div>
@stop

@section('css')
    
@stop

@section('js')
     
@stop