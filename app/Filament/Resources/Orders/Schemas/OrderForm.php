<?php
namespace App\Filament\Resources\Orders\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class OrderForm { public static function configure(Schema $schema): Schema { return $schema->components([
    Select::make('id_user')->label('Usuario comprador')->relationship('user', 'name')->searchable()->preload()->required(),
    Select::make('id_client')->label('Cliente')->relationship('client', 'document_number')->searchable()->preload(),
    Select::make('id_payment')->label('Pago')->relationship('payment', 'id_payment')->searchable()->preload(),
    TextInput::make('total')->label('Total')->numeric()->prefix('$')->minValue(0)->required(),
    Select::make('order_status')->label('Estado')->options(['pending' => 'Pendiente', 'paid' => 'Pagado', 'processing' => 'En proceso', 'shipped' => 'Enviado', 'completed' => 'Completado', 'cancelled' => 'Cancelado'])->default('pending')->required(),
    DateTimePicker::make('order_date')->label('Fecha del pedido')->default(now())->required(),
]); } }
