<?php

namespace App\Filament\Resources\Scenes\Schemas;

use App\Enums\Interaction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SceneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hint')
                    ->placeholder('Make sure to keep it compact.'),
                FileUpload::make('image')
                    ->image()
                    ->directory('stories/scenes')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ]),
                RichEditor::make('content')
                    ->required(),
                Select::make('interaction')
                    ->options(Interaction::class),
                TextInput::make('interaction_hint')
                    ->requiredIf('interaction', ['talk_back', 'soundboard'])
            ]);
    }
}
