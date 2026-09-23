<?php
namespace App\Filament\Resources\Orders\Tables;
use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order_date', 'desc')
            ->columns([
                TextColumn::make('id_order')
                    ->label('# Pedido')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Cliente')
                    ->description(fn (Order $record): ?string => $record->user?->email)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shipping_address')
                    ->label('Dirección de entrega')
                    ->default(fn (Order $record): string => $record->client?->address ?? 'Sin dirección')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('shipping_phone')
                    ->label('Teléfono')
                    ->default(fn (Order $record): string => $record->client?->phone ?? '-'),
                TextColumn::make('payment_method')
                    ->label('Método de pago')
                    ->badge()
                    ->color('info')
                    ->default(fn (Order $record): string => $record->payment?->payment_method ?? 'Contraentrega'),
                TextColumn::make('total')
                    ->label('Total pagado')
                    ->money('COP')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('order_status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'paid' => 'success',
                        'shipped' => 'primary',
                        'completed' => 'success',
                        'processing' => 'info',
                        'cancelled' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'paid' => 'Pagado',
                        'processing' => 'En proceso',
                        'shipped' => 'Enviado',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado',
                        default => ucfirst($state ?? 'Pendiente'),
                    })
                    ->sortable(),
                TextColumn::make('order_date')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
