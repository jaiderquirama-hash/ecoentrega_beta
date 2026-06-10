<?php

namespace App\Filament\Resources\ShoppingcartMS\Pages;

use App\Filament\Resources\ShoppingcartMS\ShoppingcartMResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShoppingcartMS extends ListRecords
{
    protected static string $resource = ShoppingcartMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
