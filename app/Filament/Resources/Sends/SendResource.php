<?php

namespace App\Filament\Resources\Sends;

use App\Filament\Resources\Sends\Pages\CreateSend;
use App\Filament\Resources\Sends\Pages\EditSend;
use App\Filament\Resources\Sends\Pages\ListSends;
use App\Filament\Resources\Sends\Schemas\SendForm;
use App\Filament\Resources\Sends\Tables\SendsTable;
use App\Models\Send;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SendResource extends Resource
{
    protected static ?string $model = Send::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'envio';

    public static function form(Schema $schema): Schema
    {
        return SendForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SendsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSends::route('/'),
            'create' => CreateSend::route('/create'),
            'edit' => EditSend::route('/{record}/edit'),
        ];
    }
}
