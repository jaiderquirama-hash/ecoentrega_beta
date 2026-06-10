<?php

namespace App\Filament\Resources\ShoppingcartMS;

use App\Filament\Resources\ShoppingcartMS\Pages\CreateShoppingcartM;
use App\Filament\Resources\ShoppingcartMS\Pages\EditShoppingcartM;
use App\Filament\Resources\ShoppingcartMS\Pages\ListShoppingcartMS;
use App\Filament\Resources\ShoppingcartMS\Schemas\ShoppingcartMForm;
use App\Filament\Resources\ShoppingcartMS\Tables\ShoppingcartMSTable;
use App\Models\ShoppingcartM;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShoppingcartMResource extends Resource
{
    protected static ?string $model = ShoppingcartM::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'carrito';

    public static function form(Schema $schema): Schema
    {
        return ShoppingcartMForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShoppingcartMSTable::configure($table);
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
            'index' => ListShoppingcartMS::route('/'),
            'create' => CreateShoppingcartM::route('/create'),
            'edit' => EditShoppingcartM::route('/{record}/edit'),
        ];
    }
}
