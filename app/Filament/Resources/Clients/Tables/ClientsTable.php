<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')->label('Cliente')->searchable()->sortable(),
            TextColumn::make('user.email')->label('Correo')->searchable(),
            TextColumn::make('document_number')->label('Documento')->searchable(),
            TextColumn::make('phone')->label('Teléfono'),
            TextColumn::make('address')->label('Dirección')->limit(35),
        ])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
