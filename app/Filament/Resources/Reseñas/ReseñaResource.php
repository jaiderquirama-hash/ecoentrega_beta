<?php

namespace App\Filament\Resources\Reseñas;

use App\Filament\Resources\Reseñas\Pages\CreateReseña;
use App\Filament\Resources\Reseñas\Pages\EditReseña;
use App\Filament\Resources\Reseñas\Pages\ListReseñas;
use App\Filament\Resources\Reseñas\Schemas\ReseñaForm;
use App\Filament\Resources\Reseñas\Tables\ReseñasTable;
use App\Models\Reseña;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReseñaResource extends Resource
{
    protected static ?string $model = Reseña::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Reseña';

    public static function form(Schema $schema): Schema
    {
        return ReseñaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReseñasTable::configure($table);
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
            'index' => ListReseñas::route('/'),
            'create' => CreateReseña::route('/create'),
            'edit' => EditReseña::route('/{record}/edit'),
        ];
    }
}
