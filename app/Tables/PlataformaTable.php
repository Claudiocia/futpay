<?php

namespace App\Tables;

use App\Models\Plataforma;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class PlataformaTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Plataforma::class)
            ->rowActions(fn(Plataforma $plataforma) => [
                new ShowRowAction(route('admin.plataformas.show', $plataforma)),
                new EditRowAction(route('admin.plataformas.edit', $plataforma)),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('name')->title('Nome')->searchable()->sortable()->sortByDefault('asc'),
            Column::make('sigla')->title('Sigla')->searchable(),
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
