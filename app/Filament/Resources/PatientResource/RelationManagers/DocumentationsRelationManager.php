<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DocumentationsRelationManager extends RelationManager
{
    protected static string $relationship = 'documentations';

    public function form(Form $form): Form
    {
        $patient = $this->getOwnerRecord(); // Gets the patient

        return $form
            ->schema([
                Forms\Components\Hidden::make('patient_id')->default($patient->id),

                Forms\Components\Hidden::make('unit_id')->default($patient->unit_id),

                Forms\Components\Select::make('type')
                    ->required()
                    ->label('Documentation Type')
                    ->options(function () use ($patient) {
                        $hasAssessment = $patient->documentations()
                            ->where('type', 'Assessment')
                            ->exists();

                        return $hasAssessment
                            ? ['Documentation' => 'Documentation', 'Review' => 'Review']
                            : ['Assessment' => 'Assessment'];
                    }),

                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->rows(5)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Type'),
                Tables\Columns\TextColumn::make('unit.name')->label('Unit'),
                Tables\Columns\TextColumn::make('user.name')->label('Documented By'),
                Tables\Columns\TextColumn::make('user_role')->label('Role'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Date'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data) {
                        return Documentation::create([
                            ...$data,
                            'user_id' => Auth::id(),
                            'user_role' => Auth::user()->getRoleNames()->first(),
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->hasAnyRole(['chief', 'physio'])),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
