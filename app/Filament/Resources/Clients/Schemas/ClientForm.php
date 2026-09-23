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
            Select::make('id_user')
                ->label('Usuario')
                ->relationship(
                    name: 'user',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn ($query, $record) => $query->whereDoesntHave('client', function ($q) use ($record) {
                        if ($record) {
                            $q->where('id_client', '!=', $record->id_client);
                        }
                    })
                )
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    TextInput::make('name')
                        ->label('Nombre completo')
                        ->required(),
                    TextInput::make('email')
                        ->label('Correo electrónico')
                        ->email()
                        ->required()
                        ->unique('users', 'email'),
                    TextInput::make('password')
                        ->label('Contraseña')
                        ->password()
                        ->required(),
                ])
                ->unique(table: 'clients', column: 'id_user', ignoreRecord: true),
            TextInput::make('document_number')->label('Documento')->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('phone')->label('Teléfono')->tel()->maxLength(30),
            TextInput::make('address')->label('Dirección')->maxLength(255)->columnSpanFull(),
        ]);
    }
}
