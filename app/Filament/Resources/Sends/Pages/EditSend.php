<?php

namespace App\Filament\Resources\Sends\Pages;

use App\Filament\Resources\Sends\SendResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSend extends EditRecord
{
    protected static string $resource = SendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
