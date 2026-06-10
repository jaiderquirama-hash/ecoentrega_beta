<?php

namespace App\Filament\Resources\Requestdetails\Pages;

use App\Filament\Resources\Requestdetails\RequestdetailsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRequestdetails extends ListRecords
{
    protected static string $resource = RequestdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
