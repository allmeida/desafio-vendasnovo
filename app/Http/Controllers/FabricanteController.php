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
            flash('Fabricante salvo com sucesso')->success();
            
        } catch (\Exception $e) {
            flash('Erro ao salvar Fabricante')->error();
            return back()->withInput();
        }
        return redirect()->route('fabricante.index');
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
        $fabricante = Fabricante::find($id);
        return view('fabricante.form', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fabricante $fabricante)
    {
        try {
            $fabricante->update($request->all());
            flash('Fabricante atualizado com sucesso')->success();
        } catch (\Exception $e) {
            flash('Erro ao atualizar Fabricante')->error();
            return back()->withInput();
        }
        return redirect()->route('fabricante.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabricante = Fabricante::find($id);
        $fabricante->delete();

        flash('Fabricante excluido com sucesso')->success();

        return view('fabricante.index');
    }
}
