<?php

namespace App\Filament\Resources\Scenes;

use App\Filament\Resources\Scenes\Pages\CreateScene;
use App\Filament\Resources\Scenes\Pages\EditScene;
use App\Filament\Resources\Scenes\Pages\ListScenes;
use App\Filament\Resources\Scenes\Schemas\SceneForm;
use App\Filament\Resources\Scenes\Tables\ScenesTable;
use App\Models\Scene;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SceneResource extends Resource
{
    protected static ?string $model = Scene::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;

    protected static string|UnitEnum|null $navigationGroup = 'Story';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return SceneForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ScenesTable::configure($table);
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
            'index' => ListScenes::route('/'),
            'create' => CreateScene::route('/create'),
            'edit' => EditScene::route('/{record}/edit'),
        ];
    }
}
