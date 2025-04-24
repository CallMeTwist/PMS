<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use App\Models\Unit;
use App\Models\Ward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        Forms\Components\Section::make('Personal Information')->schema([
            Forms\Components\TextInput::make('first_name')->required(),
            Forms\Components\TextInput::make('last_name')->required(),
            Forms\Components\TextInput::make('phone_number')
                ->tel()
                ->rules(['required', 'regex:/^[\d\+\-\s\(\)]+$/', 'max:20'])
                ->placeholder('+1 (929) 267-5514')
                ->label('Phone Number'),
            Forms\Components\DatePicker::make('date_of_birth')->required(),
            Forms\Components\TextInput::make('age')->numeric()->required(),
            Forms\Components\Select::make('sex')
                ->options(['Male' => 'Male', 'Female' => 'Female'])
                ->required(),
            Forms\Components\Select::make('marital_status')
                ->label('Marital Status')
                ->options([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Divorced' => 'Divorced',
                    'Widowed' => 'Widowed',
                ])
                ->required(),
        ]),
        Forms\Components\Section::make('Next of Kin & Background')->schema([
            Forms\Components\TextInput::make('next_of_kin')->required(),
            Forms\Components\TextInput::make('tribe')->required(),
            Forms\Components\TextInput::make('place_of_origin')->required(),
            Forms\Components\TextInput::make('occupation')->required(),
            Forms\Components\TextInput::make('Religion')->required(),
            Forms\Components\Textarea::make('address')->maxLength(65535),
        ]),

        Forms\Components\Section::make('Admission Details')->schema([
            Forms\Components\Toggle::make('is_in_patient')
                ->label('Is In-Patient')
                ->default(true)
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('ward_id', null)),

                    Forms\Components\Select::make('ward_id')
                        ->label('Ward')
                        ->relationship('ward', 'name')
                        ->nullable()
                        ->reactive()
                        ->visible(fn (Get $get) => $get('is_in_patient'))
                        ->required(fn (Get $get) => $get('is_in_patient')),

                    Forms\Components\Select::make('unit_id')
                        ->label('Unit')
                        ->options(fn (Get $get): Collection =>
                        $get('is_in_patient')
                        ? Ward::find($get('ward_id'))?->units()->pluck('units.name', 'units.id') ?? collect()
                                : Unit::all()->pluck('units.name', 'units.id')
                        )
                        ->default(fn (Get $get) => !$get('is_in_patient') ? 1 : null)
                        ->native(false)
        ->searchable()
        ->preload()
        ->live()
        ->required(),

                    Forms\Components\DatePicker::make('discharge_date')
                        ->visible(fn (Get $get) => !$get('is_in_patient')),
                ]),
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
        Tables\Columns\TextColumn::make('marital_status')->label('Marital Status')->sortable(),
        Tables\Columns\TextColumn::make('unit.name')->label('Unit')->sortable(),
        Tables\Columns\TextColumn::make('ward.name')->label('Ward')->sortable(),
        Tables\Columns\IconColumn::make('is_in_patient')
            ->label('Patient Type')
            ->getStateUsing(fn ($record) => $record->is_in_patient)
        ->icon(fn ($state) => $state ? 'heroicon-o-identification' : 'heroicon-o-identification')
        ->colors([
            'success' => fn ($state) => $state,
            'warning' => fn ($state) => !$state,
        ])
        ->tooltip(fn ($state) => $state ? 'In-Patient' : 'Out-Patient'),
                Tables\Columns\TextColumn::make('discharge_date')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
        // Add patient filters here
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
        return [];
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
