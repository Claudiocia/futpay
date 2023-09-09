<?php

namespace App\Tables;

use App\Models\Movimento;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\RedirectRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class ExtratoAdmTable extends AbstractTableConfiguration
{
    public int $contaId;
    protected function table(): Table
    {
        return Table::make()->model(Movimento::class)
            ->query(fn(Builder $query) => $query
                ->where('conta_id', '=', $this->contaId)
                ->whereIn('status', ['Bloqueado', 'Em operação'])
            )
            ->rowActions(fn(Movimento $movimento) => [
                new ShowRowAction(route('admin.movimentos.show', $movimento)),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('data')->title('Data')->format(
                fn(Movimento $movimento)=>
                \Carbon\Carbon::parse($movimento->data)->format('d/m/Y')
            )->sortable()->sortByDefault('desc'),
            Column::make('description')->title('Descrição'),
            Column::make('tipo')->title('Tipo'),
            Column::make('operation_key')->title('Chave de Operação')
                ->format(fn(Movimento $movimento)=>
                substr_replace($movimento->operation_key, '(...)', 20, 20)),
            Column::make('valor')->title('Valor'),
            Column::make('status')->title('Status'),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
