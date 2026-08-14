<?php
namespace App\Filament\Resources\OrderDetails\Schemas;
use Filament\Forms\Components\Select; use Filament\Forms\Components\TextInput; use Filament\Schemas\Schema;
class OrderDetailForm { public static function configure(Schema $schema): Schema { return $schema->components([
    Select::make('id_order')->label('Pedido')->relationship('order', 'id_order')->searchable()->preload()->required(), Select::make('id_product')->label('Producto')->relationship('product', 'product_name')->searchable()->preload()->required(), TextInput::make('quantity')->label('Cantidad')->integer()->minValue(1)->default(1)->required(), TextInput::make('unit_price')->label('Precio unitario')->numeric()->prefix('$')->minValue(0)->required(), TextInput::make('subtotal')->label('Subtotal')->numeric()->prefix('$')->minValue(0)->required(),
]); } }
