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
                Forms\Components\FileUpload::make('logo')
                    ->default('default.png'),
                Forms\Components\ColorPicker::make('color_primary')
                    ->required()
                    ->default('#000000'),
                Forms\Components\ColorPicker::make('color_secundary')
                    ->required()
                    ->default('#000000'),
                Forms\Components\TextInput::make('client_id'),
                Forms\Components\TextInput::make('client_secret_id'),
                Forms\Components\TextInput::make('company_id')
                    ->disabled(),
                Forms\Components\TextInput::make('location_id')
                    ->disabled(),
                Forms\Components\TextInput::make('code')
                    ->disabled(),
                Forms\Components\TextArea::make('refresh_token')
                    ->disabled(),
                Forms\Components\TextArea::make('access_token')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color_primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color_secundary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_secret_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_url')
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
