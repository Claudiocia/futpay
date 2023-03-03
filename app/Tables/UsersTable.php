<?php

namespace App\Tables;

use App\Models\Plataforma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Support\Facades\Auth;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Filters\RelationshipFilter;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()
            ->model(User::class)
            ->filters([
                new RelationshipFilter('Platafomas', 'plataformas', Plataforma::pluck('sigla', 'id')->toArray()),
            ])
            ->rowActions(fn(User $user) => [
                new ShowRowAction(route('admin.users.show', $user)),
                new EditRowAction(route('admin.users.edit', $user)),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('name')->title('Nome')->searchable()->sortable()->sortByDefault('asc'),
            Column::make('email')->title('E-mail')->searchable(),
            Column::make('nick_game')->title('Nick')->searchable(),
        ];
    }

    protected function results(): array
    {
        return [

        ];
    }
}
