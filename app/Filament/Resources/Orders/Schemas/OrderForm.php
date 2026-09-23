<?php
namespace App\Filament\Resources\Orders\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('id_user')
                ->label('Usuario comprador')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),
            TextInput::make('shipping_address')
                ->label('Dirección de entrega')
                ->maxLength(255)
                ->required(),
            TextInput::make('shipping_phone')
                ->label('Teléfono de contacto')
                ->tel()
                ->maxLength(50),
            Select::make('payment_method')
                ->label('Método de pago')
                ->options([
                    'Contraentrega' => 'Pago contra entrega',
                    'Nequi' => 'Nequi',
                    'Daviplata' => 'Daviplata',
                    'Transferencia Bancaria' => 'Transferencia Bancaria',
                    'Tarjeta de Crédito / Débito' => 'Tarjeta de Crédito / Débito',
                ])
                ->default('Contraentrega')
                ->required(),
            TextInput::make('total')
                ->label('Total ($)')
                ->numeric()
                ->prefix('$')
                ->minValue(0)
                ->required(),
            Select::make('order_status')
                ->label('Estado del pedido')
                ->options([
                    'pending' => 'Pendiente',
                    'paid' => 'Pagado',
                    'processing' => 'En proceso',
                    'shipped' => 'Enviado',
                    'completed' => 'Completado',
                    'cancelled' => 'Cancelado',
                ])
                ->default('pending')
                ->required(),
            Textarea::make('notes')
                ->label('Notas del pedido / Instrucciones de entrega')
                ->columnSpanFull(),
            DateTimePicker::make('order_date')
                ->label('Fecha del pedido')
                ->default(now())
                ->required(),
        ]);
    }
}
