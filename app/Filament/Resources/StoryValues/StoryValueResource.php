<?php

namespace App\Filament\Resources\StoryValues;

use App\Filament\Resources\StoryValues\Pages\CreateStoryValue;
use App\Filament\Resources\StoryValues\Pages\EditStoryValue;
use App\Filament\Resources\StoryValues\Pages\ListStoryValues;
use App\Filament\Resources\StoryValues\Schemas\StoryValueForm;
use App\Filament\Resources\StoryValues\Tables\StoryValuesTable;
use App\Models\StoryValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StoryValueResource extends Resource
{
    protected static ?string $model = StoryValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Sparkles;

    protected static string|UnitEnum|null $navigationGroup = 'Story';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return StoryValueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoryValuesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStoryValues::route('/'),
            'create' => CreateStoryValue::route('/create'),
            'edit' => EditStoryValue::route('/{record}/edit'),
        ];
    }
}
