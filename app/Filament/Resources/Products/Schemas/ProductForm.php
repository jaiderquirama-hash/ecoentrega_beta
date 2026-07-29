<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->label('Nombre del producto')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0)
                    ->required(),
                Select::make('size')
                    ->label('Talla')
                    ->options(['XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'Única' => 'Única'])
                    ->required(),
                Select::make('garment_condition')
                    ->label('Estado de la prenda')
                    ->options(['Nueva' => 'Nueva', 'Como nueva' => 'Como nueva', 'Buen estado' => 'Buen estado', 'Usada' => 'Usada'])
                    ->required(),
                TextInput::make('color')
                    ->label('Color')
                    ->required()
                    ->maxLength(100),
                Select::make('id_category')
                    ->label('Categoría')
                    ->relationship('category', 'category_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_user')
                    ->label('Vendedor')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                FileUpload::make('image')
                    ->label('Imagen de la prenda')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->required(),
                DateTimePicker::make('publication_date')
                    ->label('Fecha de publicación')
                    ->default(now())
                    ->required(),
            ]);
    }
}
