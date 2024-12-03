<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Filament\Resources\LeadResource\RelationManagers;
use App\Models\Lead;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->disabled()
                    ->maxLength(255),
                Select::make('user_id')
                    ->disabled()
                    ->label('Usuario')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                Textarea::make('comments')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Usuario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del lead')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo del lead')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono del lead')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListLeads::route('/'),
            //'create' => Pages\CreateLead::route('/create'),
            //'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
