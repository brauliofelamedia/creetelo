<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigResource\Pages;
use App\Filament\Resources\ConfigResource\RelationManagers;
use App\Models\Config;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigResource extends Resource
{
    protected static ?string $model = Config::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo')
                    ->default('default.png'),
                ColorPicker::make('color_primary')
                    ->required()
                    ->default('#000000'),
                ColorPicker::make('color_secundary')
                    ->required()
                    ->default('#000000'),
                TextInput::make('client_id'),
                TextInput::make('client_secret_id'),
                TextInput::make('company_id')
                    ->disabled(),
                TextInput::make('location_id')
                    ->disabled(),
                TextInput::make('code')
                    ->disabled(),
                TextArea::make('refresh_token')
                    ->disabled(),
                TextArea::make('access_token')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('logo')
                    ->searchable(),
                TextColumn::make('color_primary')
                    ->searchable(),
                TextColumn::make('color_secundary')
                    ->searchable(),
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('client_id')
                    ->searchable(),
                TextColumn::make('client_secret_id')
                    ->searchable(),
                TextColumn::make('company_id')
                    ->searchable(),
                TextColumn::make('location_id')
                    ->searchable(),
                TextColumn::make('base_url')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListConfigs::route('/'),
            'create' => Pages\CreateConfig::route('/create'),
            'edit' => Pages\EditConfig::route('/{record}/edit'),
        ];
    }
}
