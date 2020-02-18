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
        return view('pessoa.form', compact('grupos'));
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
            return redirect()->route('pessoa.index');
        } catch (\Throwable $th) {
            flash('Erro ao salvar')->error();
            return back()->withInput();
        }
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
        try {
            return view('pessoa.form', [
                'pessoa' => Pessoa::findOrFail($id),
                'grupos' => Pessoa::GRUPOS
            ]);
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return redirect()->route('pessoa.index');
        }
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
            Pessoa::find($id)->update($request->all());
            flash('Atualizado com sucesso')->success();
            return redirect()->route('pessoa.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao atualizar')->error();
            return back()->withInput();
        }
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
