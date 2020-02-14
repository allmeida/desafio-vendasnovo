@extends('adminlte::page')

@section('title', 'Formulário de Produtos')

@section('content_header')
    <h1>Formulário de Produtos</h1>
@stop

@section('content')
<div class="box box-primary">
    @if(isset($produto))
        {!! Form::model($produto, ['url' => route('produto.update', $produto), 'method' => 'put']) !!}
    @else
        {!! Form::open(['url' => route('produto.store')]) !!}
    @endif
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('descricao', 'Descrição Produto') !!}
                {!! Form::text('descricao', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('estoque', 'Estoque') !!}
                {!! Form::number('estoque', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('preco_custo', 'Preço_Custo') !!}
                {!! Form::number('preco_custo', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('preco_venda', 'Preço_Venda') !!}
                {!! Form::number('preco_venda', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fabricante_id', 'Fabricante')!!}
                {!! Form::select('fabricante_id', $fabricante) !!} 
            </div>
            <div class="form-group">
                {!! Form::label('unidade_medida', 'Unidade') !!}
                {!! Form::number('unidade_medida') !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
   
@stop