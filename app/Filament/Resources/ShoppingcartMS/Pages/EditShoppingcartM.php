<?php

namespace App\Filament\Resources\ShoppingcartMS\Pages;

use App\Filament\Resources\ShoppingcartMS\ShoppingcartMResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShoppingcartM extends EditRecord
{
    protected static string $resource = ShoppingcartMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
