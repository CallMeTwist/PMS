<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

//    public function mount(): void
//    {
//        parent::mount(); // important to keep
//        dd(auth()->user()->name, auth()->user()->getRoleNames());
//    }
}
