<?php

namespace App\Filament\Resources\Requestdetails;

use App\Filament\Resources\Requestdetails\Pages\CreateRequestdetails;
use App\Filament\Resources\Requestdetails\Pages\EditRequestdetails;
use App\Filament\Resources\Requestdetails\Pages\ListRequestdetails;
use App\Filament\Resources\Requestdetails\Schemas\RequestdetailsForm;
use App\Filament\Resources\Requestdetails\Tables\RequestdetailsTable;
use App\Models\Requestdetails;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RequestdetailsResource extends Resource
{
    protected static ?string $model = Requestdetails::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Detalles de pedido';

    public static function form(Schema $schema): Schema
    {
        return RequestdetailsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RequestdetailsTable::configure($table);
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
            'index' => ListRequestdetails::route('/'),
            'create' => CreateRequestdetails::route('/create'),
            'edit' => EditRequestdetails::route('/{record}/edit'),
        ];
    }
}
