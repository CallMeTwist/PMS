<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use App\Models\Ward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(255)
                    ->required(),
                Forms\Components\Select::make('sex')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ])
                    ->default('Male')
                    ->required(),
                Forms\Components\TextInput::make('next_of_kin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tribe')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('place_of_origin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Religion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\Select::make('ward_id')
                    ->relationship('wards', 'name')
                    ->nullable()
                    ->reactive()
                    ->label('Ward'),
                Forms\Components\Select::make('unit_id')
                    ->options(fn(Get $get): Collection => Ward::find($get('ward_id'))?->units()->pluck('name', 'id') ?? collect())
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\Toggle::make('is_in_patient')
                    ->default(true)
                    ->label('Is In-Patient'),
                Forms\Components\DatePicker::make('discharge_date')
                    ->label('Discharge Date')
                    ->visible(fn ($get) => !$get('is_in_patient')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone_number')->searchable(),
                Tables\Columns\TextColumn::make('age')->sortable(),
                Tables\Columns\TextColumn::make('sex'),
                Tables\Columns\TextColumn::make('unit.name')->label('Unit')->sortable(),
                Tables\Columns\TextColumn::make('ward.name')->label('Ward')->sortable(),
                Tables\Columns\IconColumn::make('is_in_patient')
                    ->boolean()
                    ->label('In-Patient'),
                Tables\Columns\TextColumn::make('discharge_date')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
