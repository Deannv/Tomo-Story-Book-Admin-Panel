<?php

namespace App\Filament\Resources\Stories\Schemas;

use App\Enums\Interaction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->autosize(),
                TextInput::make('read_length_minute')
                    ->required()
                    ->numeric(),
                Select::make('tags')
                    ->required()
                    ->multiple()
                    ->relationship(
                        name: 'tags',
                        titleAttribute: 'name',
                    )
                    ->createOptionForm([
                        TextInput::make('name'),
                    ])
                    ->preload()
                    ->searchable(),
                FileUpload::make('cover_image')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('story_images')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->required(),
                FileUpload::make('theme_sound')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('story_sounds')
                    ->required(),
                Section::make('Story Values')
                    ->description('What kids will learn from this story?')
                    ->columns(2)
                    ->columnSpan(2)
                    ->schema([
                        Repeater::make('storyValues')
                            ->label('Story Values')
                            ->relationship('storyValues')
                            ->schema([
                                TextInput::make('description')
                                    ->placeholder('Make sure to keep it compact.'),
                            ])
                            ->collapsible()
                            ->addActionLabel('Add Value')
                            ->required(),
                        Repeater::make('comprehensiveQuestions')
                            ->label('Comprehensive Questions')
                            ->relationship('comprehensiveQuestions')
                            ->schema([
                                TextInput::make('question'),
                                TextInput::make('parent_tip')
                                    ->placeholder('Make sure to keep it compact.'),
                            ])
                            ->collapsible()
                            ->addActionLabel('Add Question')
                            ->required(),
                    ]),
                Section::make('Scenes')
                    ->description('Scenes (Card) for the story, reorderable.')
                    ->schema([
                        Repeater::make('scenes')
                            ->relationship('scenes')
                            ->schema([
                                TextInput::make('hint')
                                    ->placeholder('Make sure to keep it compact.'),
                                FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->visibility('public')
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
                                FileUpload::make('narration')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('stories/scenes/narrations'),
                                Select::make('interaction')
                                    ->options(Interaction::class),
                                FileUpload::make('soundboard')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('stories/scenes/soundboards')
                                    ->requiredIf('interaction', 'soundboard'),
                                TextInput::make('interaction_hint')
                                    ->requiredIf('interaction', ['talk_back', 'soundboard']),
                            ])
                            ->orderColumn('order')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->addActionLabel('Add Scene'),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
