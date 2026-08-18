<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Members\Schemas\MemberInfolist;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::User;

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'profile';

    protected static ?string $title = 'My Profile';

    public $record = null;

    public function mount(): void
    {
        $this->record = Auth::user()->member;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('member');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                EmbeddedSchema::make('infolist'),
            ]);
    }

    public function defaultInfolist(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->record($this->record);
    }

    public function infolist(Schema $schema): Schema
    {
        return MemberInfolist::configure($schema);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->label('Edit Profile')
                ->icon('heroicon-o-pencil')
                ->url(fn () => EditProfile::getUrl()),
        ];
    }
}
