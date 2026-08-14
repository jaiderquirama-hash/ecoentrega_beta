<?php
namespace App\Filament\Resources\CartDetails\Pages; use App\Filament\Resources\CartDetails\CartDetailResource; use Filament\Actions\CreateAction; use Filament\Resources\Pages\ListRecords;
class ListCartDetails extends ListRecords { protected static string $resource = CartDetailResource::class; protected function getHeaderActions(): array { return [CreateAction::make()]; } }
