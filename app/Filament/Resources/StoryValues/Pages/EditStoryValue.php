<?php

namespace App\Filament\Resources\StoryValues\Pages;

use App\Filament\Resources\StoryValues\StoryValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStoryValue extends EditRecord
{
    protected static string $resource = StoryValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
