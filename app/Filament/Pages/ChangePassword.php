<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'password/change';

    protected static ?string $title = 'Change Password';

    public ?array $data = [];

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                EmbeddedSchema::make('form'),
            ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('current_password')
                    ->label('Current Password')
                    ->password()
                    ->required()
                    ->currentPassword(),
                TextInput::make('new_password')
                    ->label('New Password')
                    ->password()
                    ->required()
                    ->rules([Password::defaults()])
                    ->confirmed(),
                TextInput::make('new_password_confirmation')
                    ->label('Confirm New Password')
                    ->password()
                    ->required(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Auth::user()->update([
            'password' => $data['new_password'],
        ]);

        $this->redirect(Dashboard::getUrl());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Change Password')
                ->action('save'),
        ];
    }
}
