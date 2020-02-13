<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDatatable;
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
        return view('produto.form');
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
            
        } catch (\Throwable $th) {
            flash('Erro ao salvar')->error();
            return back()->withInput();
        }
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto.form', compact('produto'));
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
}
