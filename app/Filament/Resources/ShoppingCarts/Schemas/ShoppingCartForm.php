<?php
namespace App\Filament\Resources\ShoppingCarts\Schemas;
use Filament\Forms\Components\DateTimePicker; use Filament\Forms\Components\Select; use Filament\Schemas\Schema;
class ShoppingCartForm { public static function configure(Schema $schema): Schema { return $schema->components([
    Select::make('id_user')->label('Usuario')->relationship('user', 'name')->searchable()->preload()->required()->unique(ignoreRecord: true), DateTimePicker::make('creation_date')->label('Fecha de creación')->default(now())->required(),
]); } }
