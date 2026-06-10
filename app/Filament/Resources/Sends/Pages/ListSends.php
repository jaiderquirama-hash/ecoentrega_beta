<?php

namespace App\Filament\Resources\Sends\Pages;

use App\Filament\Resources\Sends\SendResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSends extends ListRecords
{
    protected static string $resource = SendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
