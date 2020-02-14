@extends('adminlte::page')

@section('title', 'Formulário de Produtos')

@section('content_header')
    <h1>Formulário de Produtos</h1>
@stop

@section('content')

    @if(isset($produto))
        {!! Form::model($produto, ['url' => route('produto.update', $produto), 'method' => 'put']) !!}
    @else
        {!! Form::open(['url' => route('produto.store')]) !!}
    @endif
        {!! Form::label('descricao', 'Descrição Produto') !!}
        {!! Form::text('descricao') !!}

        {!! Form::label('estoque', 'Estoque') !!}
        {!! Form::number('estoque') !!}

        {!! Form::label('preco_custo', 'Preço_Custo') !!}
        {!! Form::number('preco_custo') !!}

        {!! Form::label('preco_venda', 'Preço_Venda') !!}
        {!! Form::number('preco_venda') !!}

         {!! Form::label('fabricante_id', 'Fabricante')!!}
        {!! Form::select('fabricante_id', $fabricante) !!} 

        {!! Form::label('unidade_medida', 'Unidade') !!}
        {!! Form::number('unidade_medida') !!}
        <br>
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-sm']) !!}
    {!! Form::close() !!}

@stop

@section('css')
    
@stop

@section('js')
   
@stop