<?php

namespace App\Filament\Resources\DocumentationResource\Pages;

use App\Filament\Resources\DocumentationResource;
use App\Models\Documentation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDocumentation extends CreateRecord
{
    protected static string $resource = DocumentationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get the authenticated user
        $user = Auth::user();

        // Add user_id and user_role
        $data['user_id'] = $user->id;
        $data['user_role'] = $user->getRoleNames()->first(); // Assuming Spatie roles

        // If the user has a unit relationship
        if ($user->unit_id ?? false) {
            $data['unit_id'] = $user->unit_id;
        }

return $data;
}

protected function afterCreate(): void
{
    // Optional: Add any logic that should happen after creation
    // like redirecting or flashing custom messages.
}
}
