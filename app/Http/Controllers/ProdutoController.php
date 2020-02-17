<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDatatable;
use App\Fabricante;
use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProdutoDatatable $produtoDatatable)
    {
        return $produtoDatatable->render('produto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Produto::UNIDADE_MEDIDAS);
        $fabricante = Fabricante::all()->pluck('nome', 'id');
        $unidades_medidas = Produto::UNIDADES_MEDIDAS;

        return view('produto.form',[
            'fabricante' => $fabricante,
            'unidades_medidas' => $unidades_medidas
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
        //dd($request->all());
        try {
            Produto::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('produto.index');
        } catch (\Throwable $th) {
            //dd($th);
            flash('Ops! Ocorreu um erro ao salvar')->error();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Produto::findOrfail($id);
        } catch (\Throwable $th) {
            abort(403, 'Erro ao selecionar o produto');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $fabricante = Fabricante::all()->pluck('nome','id');
            return view('produto.form', compact('fabricante'), [
                'produto' => Produto::findOrFail($id)
            ]);
        } catch (\Throwable $th) {
            //dd($th);
            flash('Ops! Ocorreu um erro ao salvar')->error();
            return back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        try {
            $produto->update($request->all());
            flash('Atualizado com sucesso')->success();
        } catch (\Throwable $th) {
            flash('Erro ao atualizar')->error();
            return back()->withInput();
        }
        return redirect()->route('produto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Produto::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro Excluir');
        }
    }

    public function listaProdutos(Request $request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Produto::select('id', 'descricao as text')
                            ->limit(10)
                            ->get();
        }

        return Produto::select('id', 'descricao as text')
                            ->where('descricao', 'like', '%' . $termoPesquisa . '%')
                            ->limit(10)
                            ->get();
    }
}
