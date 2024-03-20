<?php

namespace App\Filament\Resources\SubsubpastaResource\Pages;

use App\Filament\Resources\SubsubpastaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubsubpastas extends ManageRecords
{
    protected static string $resource = SubsubpastaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
