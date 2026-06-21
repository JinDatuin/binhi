<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Members\Schemas\MemberForm;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'profile/edit';

    protected static ?string $title = 'Edit Profile';

    public ?array $data = [];

    public $record = null;

    public function mount(): void
    {
        $this->record = Auth::user()->member;

        $this->fillForm();
    }

    public function fillForm(): void
    {
        $this->form->fill($this->record?->toArray());
    }

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
            ->model($this->record)
            ->statePath('data')
            ->operation('edit');
    }

    public function form(Schema $schema): Schema
    {
        return MemberForm::configure($schema);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        $this->redirect(Profile::getUrl());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->action('save'),
        ];
    }
}
