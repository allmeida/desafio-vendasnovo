@extends('adminlte::page')

@section('title', 'Formulário de Vendas')

@section('content_header')
    <h1>Formulário de Vendas</h1>
@stop

@section('content')

    <form action="{{ route('venda.store') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="pessoa_id">Cliente</label>
                <select class="form-control" name="'pessoa_id'" id="select_clientes"></select>
            </div>
            <div class="form-group">
                <label for="observacao">Observação</label>
                <textarea name="form-control" name="observacao" id="observacao" cols="3" rows="10"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Finalizar Venda</button>
                <span id="total-geral" style="font-size: 25px; margin-left: 25px;">Total: 0.0</span>
            </div>

            <div style="height: 15px;"></div>

            <div class="box">
                <div class="box-header with-border">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="pessoa_id">Produtos</label>
                        <select class="form-control" id="select-produtos"></select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="pessoa_id">Quantidade</label>
                        <input class="form-control" type="number" id="quantidade_add">
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="pessoa-id">Ação</label>
                        <button type="button" class="btn btn-primary" onclick="adicionarProduto()">Adicionar</button>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <td>Produto</td>
                        <td>Quantidade</td>
                        <td>Preço</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody id="itens-venda">
                </tbody>
            </table>


    </form>

@stop

@section('css')

@stop

@section('js')
<script>
    var total-Geral = 0;

    $('#select-clientes').select2( {
        ajax: {
            url: '{{ route('lista.clientes') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    serchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        }
    });

    $('#select-produtos').select2( {
        ajax: {
            url: '{{ route('lista.produtos') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    serchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        }
    });

    $('#form-venda').submit(function(){
        if (totalGeral == 0) {
            bootbox.alert('Ops!, A venda precisa ter pelo menos um produto');
            return false;
        }
        return true;
    });

    function adicionarProduto() {
        let produto = $('#select-produtos').val();
        let quantidade = $('#quantidade_add').val();

        if (produto && quantidade) {
            axios.get('{{ route('produtos.index') }}/' + produto)
                .then((response) => {
                    exibirItem(response.data, quantidade);
                })
                catch((error) => {
                    bootbox.alert('Ops!, Erro ao selecionar o produto');
                });
        } else {
            bootbox.alert('Escolha o produto e informe a quantidade');
        }
    }

    function exibirItem(produto, quantidade) {

        let total = parseFloat(produto.preco_venda) * quantidade;
        totalGeral += total;

        let item = "<tr>";
            item += "<th><input class='form-control' value='" + produto.descricao + "' disabled";
            item += "<input style='display:none' name='produto_id[]' value='" + produto.id + "' readonIy></th>";
            item += "<th><input class='form-control' name='quantidade[]' value='" + quantidade + "' readonIy></th>";
            item += "<th><input class='form-control' value='" + produto.preco_venda + "' disabled></th>";
            item += "<th><input class='form-control' value='" + total.toFixed(2) + "' disabled></th>";
            item += "</tr>";

        $('#total-geral').html('Total: ' + totalGeral.toFixed(2));
        $('#itens-venda').append(item);

    }
</script>

@stop
