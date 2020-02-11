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
    {!! $dataTable->scripts() !!}
@stop