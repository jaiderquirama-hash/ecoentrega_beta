<?php
namespace App\Filament\Resources\Orders\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
class OrdersTable { public static function configure(Table $table): Table { return $table->defaultSort('order_date', 'desc')->columns([
    TextColumn::make('id_order')->label('Pedido')->sortable(), TextColumn::make('user.name')->label('Usuario')->searchable(), TextColumn::make('client.document_number')->label('Documento'), TextColumn::make('total')->label('Total')->money('COP')->sortable(), TextColumn::make('order_status')->label('Estado')->badge(), TextColumn::make('order_date')->label('Fecha')->dateTime('d/m/Y H:i')->sortable(),
])->recordActions([EditAction::make()])->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]); } }
