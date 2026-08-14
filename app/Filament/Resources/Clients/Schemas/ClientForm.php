<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('id_user')->label('Usuario')->relationship('user', 'name')->searchable()->preload()->required()->unique(ignoreRecord: true),
            TextInput::make('document_number')->label('Documento')->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('phone')->label('Teléfono')->tel()->maxLength(30),
            TextInput::make('address')->label('Dirección')->maxLength(255)->columnSpanFull(),
        ]);
    }
}
