<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActorResource\Pages;
use App\Filament\Resources\ActorResource\RelationManagers;
use App\Models\Actor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActorResource extends Resource
{
    protected static ?string $model = Actor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $modelLabel = 'Films Actors';

    protected static ?string $navigationLabel = 'Actors';

    protected static ?string $navigationGroup = 'Database Managment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Actors Info')->schema([
                    Forms\Components\TextInput::make('fullname')->required()->unique(),
                    Forms\Components\RichEditor::make('bio')->required()->unique(),
                ])->columns(1),
                Forms\Components\Section::make('Actors Image')->schema([
                    Forms\Components\FileUpload::make('avatar')->directory('actors_images')->visibility('public'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')->searchable(),
                Tables\Columns\ImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('created_at')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->date('d M Y')->sortable()
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
            'index' => Pages\ListActors::route('/'),
            'create' => Pages\CreateActor::route('/create'),
            'edit' => Pages\EditActor::route('/{record}/edit'),
        ];
    }
}
