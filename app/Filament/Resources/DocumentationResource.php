<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationResource\Pages;
use App\Filament\Resources\DocumentationResource\RelationManagers;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function canViewAny(): bool
    {
        return Auth::user()->can('viewAny', Documentation::class);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create', Documentation::class);
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('update', $record);
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('delete', $record);
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => Auth::user()->can('update', $record)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => Auth::user()->can('delete', $record)),
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
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit')
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can('viewAny', Documentation::class);
    }
}
