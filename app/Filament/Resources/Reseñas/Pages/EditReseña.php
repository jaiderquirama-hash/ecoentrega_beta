<?php

namespace App\Filament\Resources\Reseñas\Pages;

use App\Filament\Resources\Reseñas\ReseñaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReseña extends EditRecord
{
    protected static string $resource = ReseñaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
