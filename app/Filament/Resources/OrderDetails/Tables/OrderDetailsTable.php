<?php
namespace App\Filament\Resources\OrderDetails\Tables;
use Filament\Actions\BulkActionGroup; use Filament\Actions\DeleteBulkAction; use Filament\Actions\EditAction; use Filament\Tables\Columns\TextColumn; use Filament\Tables\Table;
class OrderDetailsTable { public static function configure(Table $table): Table { return $table->columns([
    TextColumn::make('id_order')->label('Pedido')->sortable(), TextColumn::make('product.product_name')->label('Producto')->searchable(), TextColumn::make('quantity')->label('Cantidad')->sortable(), TextColumn::make('unit_price')->label('Precio unitario')->money('COP'), TextColumn::make('subtotal')->label('Subtotal')->money('COP')->sortable(),
])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]); } }
