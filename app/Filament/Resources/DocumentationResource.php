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
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->relationship('patient', 'first_name')
                    ->searchable()
                    ->required()
                    ->reactive() // important!
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            $patient = \App\Models\Patient::find($state);
                            $set('unit_id', $patient?->unit_id); // Automatically set unit_id
                        }
                    }),

                Forms\Components\Select::make('unit_id')
                    ->label('Unit')
                    ->relationship('unit', 'name')
                    ->searchable()
                    ->disabled()
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Documentation Type')
                    ->options([
                        'assessment' => 'Assessment',
                        'documentation' => 'Documentation',
                        'review' => 'Review',
                    ])
                    ->default('documentation')
                    ->required(),

                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->rows(10)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.first_name')
                    ->label('Patient'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Documented By'),
                Tables\Columns\TextColumn::make('user_role')
                    ->label('Role'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Date'),
            ])
            ->defaultSort('created_at', 'desc')
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
