<?php

namespace App\Tables;

use App\Models\Conta;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\Result;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class ContasTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()
            ->model(Conta::class)
            ->rowClass(fn(Conta $conta) => [
                'table-danger'=> $conta->active == 'n',
            ])
            ->rowActions(fn(Conta $conta) => [
                new ShowRowAction(route('admin.contas.show', $conta)),
                new EditRowAction(route('admin.contas.edit', $conta)),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('user_id')->title('Nome')
                ->format(fn(Conta $conta)=> $conta->user->name)
                ->searchable()->sortable()->sortByDefault(),
            Column::make('numero')->title('Numero')->searchable(),
            Column::make('saldo')->title('saldo'),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
            //Soma total dos saldos
            Result::make()->title('Total do saldo em contas')->format(static fn(
                Builder $totalRowsQuery,
                Collection $displayedRowsCollection
            ) => $displayedRowsCollection->where('saldo', '>', 0.00)->sum('saldo')),

            //Numero de contas inativas
            Result::make()->title('Total de contas inativas')->format(static fn(
               Builder $totalRowsQuery,
               Collection $displayedRowsCollection
            ) => $displayedRowsCollection->where('active', '=', 'n')->count()),
        ];
    }
}
