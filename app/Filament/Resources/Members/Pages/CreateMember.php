<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = User::create([
            'name' => trim("{$data['firstname']} {$data['lastname']}"),
            'email' => $data['email_address'],
            'password' => 'password',
        ]);

        $user->assignRole('member');

        $data['user_id'] = $user->id;

        return static::getModel()::create($data);
    }
}
