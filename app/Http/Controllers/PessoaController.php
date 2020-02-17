<?php

namespace App\Http\Controllers;

use App\DataTables\PessoaDatatable;
use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PessoaDatatable  $pessoaDatatable)
    {
        return $pessoaDatatable->render('pessoa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Pessoa::GRUPOS;
        return view('pessoa.form');
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
            Pessoa::create($request->all());
            flash('Salvo com sucesso')->success();

        } catch (\Throwable $th) {
            flash('Erro ao salvar')->error();
            return back()->withInput();
        }
        return redirect()->route('pessoa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pessoa = Pessoa::find($id);
        return view('pessoa.form', compact('pessoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        try {
            $pessoa->update($request->all());
            flash('Atualizado com sucesso')->success();
        } catch (\Throwable $th) {
            flash('Erro ao atualizar')->error();
            return back()->withInput();
        }
        return redirect()->route('pessoa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Pessoa::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro Excluir');
        }
    }

    public function listaClientes(Request $request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Pessoa::select('id', 'nome as text')
                            ->where('grupo', Pessoa::CLIENTE)
                            ->limit(10)
                            ->get();
        }

        return Pessoa::select('id', 'nome as text')
                            ->where('grupo', Pessoa::CLIENTE)
                            ->where('nome', 'like', '%' . $termoPesquisa . '%')
                            ->limit(10)
                            ->get();
    }

}
