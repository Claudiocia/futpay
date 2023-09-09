<?php

namespace App\Tables;

use App\Models\Taxa;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\RedirectRowAction;
use Okipa\LaravelTable\Table;

class TaxasTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Taxa::class)
            ->rowActions(fn(Taxa $taxa) => [
                new EditRowAction(route('admin.taxas.edit', $taxa)),
                new RedirectRowAction(route('admin.taxas.show', $taxa),
                    'Delete',
                    '<i class="fa-solid fa-trash-can" style="color: #f10427;"></i>'),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('operation')->title('Aplicação')->sortable(),
            Column::make('tipo')->title('Tipo')
                ->format(fn(Taxa $taxa)=>$taxa->tipo == 1 ? 'Valor Fixo' : 'Percentual'),
            Column::make('valor')->title('Valor')
                ->format(fn(Taxa $taxa) => $taxa->tipo == 1 ? 'R$ '.number_format($taxa->valor, 2, ",", ".") : $taxa->valor.'%'),
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
