<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //form actions
    protected function getFormActions(): array
    {
        return [
            Action::make('cancel')
                ->label('Cancel')
                ->color('secondary')
                ->outlined()
                ->url($this->getResource()::getUrl('index')),
            Action::make('save')
                ->label('Save')
                ->submit('save')
                ->color('primary')
                ->action(function () {
                    $this->save();
                }),

        ];
    }
}
