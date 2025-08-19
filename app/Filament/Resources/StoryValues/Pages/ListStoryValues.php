<?php

namespace App\Filament\Resources\StoryValues\Pages;

use App\Filament\Resources\StoryValues\StoryValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStoryValues extends ListRecords
{
    protected static string $resource = StoryValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
