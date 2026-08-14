<?php
namespace App\Filament\Resources\ShoppingCarts\Tables;
use Filament\Actions\BulkActionGroup; use Filament\Actions\DeleteBulkAction; use Filament\Actions\EditAction; use Filament\Tables\Columns\TextColumn; use Filament\Tables\Table;
class ShoppingCartsTable { public static function configure(Table $table): Table { return $table->columns([
    TextColumn::make('id_cart')->label('Carrito')->sortable(), TextColumn::make('user.name')->label('Usuario')->searchable()->sortable(), TextColumn::make('user.email')->label('Correo')->searchable(), TextColumn::make('creation_date')->label('Creado')->dateTime('d/m/Y H:i')->sortable(),
])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]); } }
