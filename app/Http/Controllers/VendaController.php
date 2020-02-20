<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDatatable;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendaDatatable $vendaDatatable)
    {
        return $vendaDatatable->render('venda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formas_pagamento = Venda::FORMAS_PAGAMENTO;
        return view('venda.form', [
            'formas_pagamento' => $formas_pagamento
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            /**
             * DB::transaction()
             * auxilia para a gravação do código, para detectar erros,
             * iniciar uma transação, confirmar a transação e, opcionalmente,
             * reverter (cancelar a transação) se ocorrer um erro.
             */
            DB::beginTransaction();
            $venda = Venda::create([
                'pessoa_id' => $request->pessoa_id,
                'observacao' => $request->observacao,
                'desconto' => 0,
                'acrescimo' => 0,
                'total' => 0,
            ]);

            $totalGeral = 0;

            foreach ( $request->produto_id as $indice => $valor ) {
                $produto = Produto::findOrFail($valor);
                $quantidade = $request->quantidade[$indice];

                $totalItem = $produto->preco_venda * $quantidade;
                $totalGeral += $totalItem;

                $venda->itensVenda()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'valor_unitario' => $produto->preco_venda,
                    'valor_total' => $totalItem
                ]);
            }

            $venda->update(['total' => $totalGeral]);

            DB::commit();
            flash('Venda finalizada com sucesso')->success();
            return redirect()->route('venda.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            flash('Ops! Ocorreu um erro ao salvar a venda')->error();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $venda = Venda::find($id);
            return view('venda.show', compact('venda'));
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao exibir a venda')->error();
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
