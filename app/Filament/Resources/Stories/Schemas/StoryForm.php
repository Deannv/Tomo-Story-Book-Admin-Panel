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
                TextInput::make('title'),
                Textarea::make('description')
                    ->autosize(),
                TextInput::make('read_length_minute')
                    ->numeric(),
                Select::make('tags')
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
                    ]),
                FileUpload::make('theme_sound')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('story_sounds'),
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
                            ->addActionLabel('Add Value'),
                        Repeater::make('comprehensiveQuestions')
                            ->label('Comprehensive Questions')
                            ->relationship('comprehensiveQuestions')
                            ->schema([
                                TextInput::make('question'),
                                TextInput::make('parent_tip')
                                    ->placeholder('Make sure to keep it compact.'),
                            ])
                            ->collapsible()
                            ->addActionLabel('Add Question'),
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
