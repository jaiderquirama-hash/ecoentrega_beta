<?php

namespace App\Filament\Resources\Requestdetails\Pages;

use App\Filament\Resources\Requestdetails\RequestdetailsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRequestdetails extends EditRecord
{
    protected static string $resource = RequestdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
