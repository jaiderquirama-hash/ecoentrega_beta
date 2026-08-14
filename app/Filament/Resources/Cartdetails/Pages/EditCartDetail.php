<?php
namespace App\Filament\Resources\CartDetails\Pages; use App\Filament\Resources\CartDetails\CartDetailResource; use Filament\Actions\DeleteAction; use Filament\Resources\Pages\EditRecord;
class EditCartDetail extends EditRecord { protected static string $resource = CartDetailResource::class; protected function getHeaderActions(): array { return [DeleteAction::make()]; } }
