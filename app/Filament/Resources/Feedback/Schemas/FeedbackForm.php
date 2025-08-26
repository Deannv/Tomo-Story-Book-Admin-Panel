<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')
                    ->relationship('story', 'title')
                    ->required(),
                TextInput::make('effectiveness')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('comments')
                    ->columnSpanFull(),
                TextInput::make('child_age')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('child_gender'),
            ]);
    }
}
