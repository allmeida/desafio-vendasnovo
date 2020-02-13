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
                {!! Form::text('cep', null, ['placeholder' => 'Cep', 'onfocusout' => 'buscaCep()']) !!}
            
                {!! Form::label('logradouro', 'Logradouro') !!}
                {!! Form::text('logradouro', null, ['placeholder' => 'Logradouro', 'onfocusout' => 'buscaCep()']) !!}
            
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro', null, ['placeholder' => 'Bairro', 'onfocusout' => 'buscaCep()']) !!}
                
                {!! Form::label('localidade', 'Localidade') !!}
                {!! Form::text('localidade', null, ['placeholder' => 'Localidade', 'onfocusout' => 'buscaCep()']) !!}
            
                {!! Form::label('grupo') !!}
                {!! Form::select('grupo', [
                                    '0' => 'Cliente',
                                    '1' => 'Fornecedor',
                                    '2' => 'Revendedor',
                                    '3' => 'Colaborador',
                ]); !!}
                <br>
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-sm']) !!}
            
        </div>
    {!! Form::close() !!}
</div>
@stop

@section('css')
    
@stop

@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
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