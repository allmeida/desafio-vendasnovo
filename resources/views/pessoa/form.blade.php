@extends('adminlte::page')

@section('title', 'Formulário de Pessoas')

@section('content_header')
    <h1>Formulário de Pessoas</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-primary">
    @if(isset($pessoa))
    {!! Form::model($pessoa, ['method' => 'put', 'route' => ['pessoa.update', $pessoa->id]]) !!}

    @else
    {!! Form::open(['url' => route('pessoa.store')]) !!}
    @endif
    @csrf
        <div class="box-body">
            <div class="form-group @error('nome') has-error @enderror">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                @error('nome')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group @error('telefone') has-error @enderror">
                {!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
                @error('telefone')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group @error('cpf') has-error @enderror">
                {!! Form::label('cpf', 'Cpf') !!}
                {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
                @error('cpf')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">    
                {!! Form::label('cep', 'Cep') !!}
                {!! Form::text('cep', null, ['class' => 'form-control', 'placeholder' => 'Cep', 'onfocusout' => 'buscaCep()']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('logradouro', 'Logradouro') !!}
                {!! Form::text('logradouro', null, ['class' => 'form-control', 'placeholder' => 'Logradouro', 'onfocusout' => 'buscaCep()']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro', null, ['class' => 'form-control', 'placeholder' => 'Bairro', 'onfocusout' => 'buscaCep()']) !!}
            </div>
            <div class="form-group">    
                {!! Form::label('localidade', 'Localidade') !!}
                {!! Form::text('localidade', null, ['class' => 'form-control', 'placeholder' => 'Localidade', 'onfocusout' => 'buscaCep()']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('grupo') !!}
                {!! Form::select('grupo', [
                                    '0' => 'Cliente',
                                    '1' => 'Fornecedor',
                                    '2' => 'Revendedor',
                                    '3' => 'Colaborador',
                ]); !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@stop

@section('css')
    
@stop

@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $('#cpf').mask('000.000.000-00', {reverse: true});

        function buscaCep() {
            let cep = document.getElementById('cep').value;
            let url = 'https://viacep.com.br/ws/' + cep + '/json/';
            
            axios.get(url)
                .then(function (response) {
                    document.getElementById('logradouro').value = response.data.logradouro
                    document.getElementById('bairro').value = response.data.bairro
                    document.getElementById('localidade').value = response.data.localidade
                })
                .catch(function (error) {
                    alert('Ops! CEP não encontrado');
                })
        }
    </script>  
@stop