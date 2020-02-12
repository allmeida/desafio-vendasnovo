@extends('adminlte::page')

@section('title', 'Lista de Fabricantes')

@section('content_header')
    @include('flash::message')
    <h1>Lista de Fabricantes</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        {!!  $dataTable->table() !!}
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script>
    function excluirFabricante(id) {
        bootbox.confirm("Deseja mesmo excluir esse fabricante?", function(sim) {
            if (sim) {
                axios.delete('/fabricante/' + id)
                    .then(function (resposta) {
                        window.location.href = "/fabricante";
                    })
                    .catch(function (erro) {
                        bootbox.alert("Ocorreu um erro: " + erro);
                    })
            }
        });
    }
</script>
    {!! $dataTable->scripts() !!}
@stop