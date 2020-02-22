<?php

namespace App\DataTables;

use App\Pessoa;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class PessoaDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('action', function ($pessoa) {

            $acoes = link_to(
                        route('pessoa.edit', $pessoa),
                        ' Editar',
                        ['class' => 'btn btn-sm btn-primary far fa-edit']
            );

            $acoes .= FormFacade::button(
                        ' Excluir',
                        ['class' =>
                            'btn btn-sm btn-danger far fa-trash-alt',
                            'onclick' => "excluir ('" . route('pessoa.destroy', $pessoa) . "')"
                        ]
                    );
            return $acoes;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\PessoaDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pessoa $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pessoadatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [                 
            Column::make('id'),
            Column::make('nome'),
            Column::make('telefone'),
            Column::make('cpf'),
            Column::make('email'),
            Column::make('cep'),
            Column::make('logradouro'),
            Column::make('bairro'),
            Column::make('localidade'),
            Column::make('grupo'),
            Column::computed('action')
                    ->title('Ações')
                    ->exportable(false)
                    ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pessoa_' . date('YmdHis');
    }
}
