<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilmResource\Pages;
use App\Filament\Resources\FilmResource\RelationManagers;
use App\Models\Film;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FilmResource extends Resource
{
    protected static ?string $model = Film::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Films Managment';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Information about Film")->schema([
                    Forms\Components\TextInput::make('title')->unique()->required(),
                    Forms\Components\TextInput::make('trailer')->required()->helperText('link from YouTube'),
                    Forms\Components\RichEditor::make('description')->required()->columnSpanFull(),
                ])->columns(2),
                Forms\Components\Section::make('Upload thumbnail')->schema([
                    Forms\Components\FileUpload::make('thumbnail')->required()
                ]),
                Forms\Components\Section::make('Actors, Directors and Categories')->schema([
                    Select::make('actors')->label('Actors')->multiple()->relationship('actors', 'fullname'),
                    Select::make('directors')->label('Directors')->multiple()->relationship('directors', 'fullname'),
                    Select::make('categories')->label('categories')->multiple()->relationship('categories', 'category'),
                ]),
                Forms\Components\Section::make('Budget, Year and rating')->schema([
                    Forms\Components\TextInput::make('rating')->numeric()->required(),
                    Forms\Components\TextInput::make('budget')->numeric()->required()->prefixIcon('heroicon-o-currency-dollar'),
                    Forms\Components\TextInput::make('year')->numeric()->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }
}
