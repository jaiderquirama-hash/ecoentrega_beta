<?php

namespace App\Filament\Resources\Reseñas\Pages;

use App\Filament\Resources\Reseñas\ReseñaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReseñas extends ListRecords
{
    protected static string $resource = ReseñaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
