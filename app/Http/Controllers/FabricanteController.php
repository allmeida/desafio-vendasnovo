<?php

namespace App\Http\Controllers;

use App\DataTables\FabricanteDatatable;
use App\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FabricanteDatatable  $fabricanteDatatable)
    {
        //return view('fabricante.index');
        return $fabricanteDatatable->render('fabricante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabricante.form');
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
            Fabricante::create($request->all());
            flash('Salvo com sucesso')->success();
            return redirect()->route('fabricante.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao salvar')->error();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return view('fabricante.form', [
                'fabricante' =>  Fabricante::findOrFail($id)
            ]);
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao selecionar')->error();
            return redirect()->route('fabricante.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Fabricante::find($id)->update($request->all());
            flash('Atualizado com sucesso')->success();
            return redirect()->route('fabricante.index');
        } catch (\Throwable $th) {
            flash('Ops! Ocorreu um erro ao atualisar')->error();
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Fabricante::find($id)->delete();
        } catch (\Throwable $th) {
            abort(403, 'Erro excluir');
        }
    }
}
