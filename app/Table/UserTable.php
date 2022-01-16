<?php

namespace App\Table;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserTable
{
    public function columns(): array
    {
        return [
            'name' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'email' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'role' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'verified_at' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'created_at' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'action' => [
                'sortable' => false,
                'searchable' => false,
            ],
        ];
    }

    public function query(Request $request): LengthAwarePaginator
    {
        return User::query()->user()
            ->paginate(10)->withQueryString()->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles()->select('id', 'name')->first(),
                'created_at' => $user->created_at->format('d/m/y'),
                'verified_at' => $user->email_verified_at?->format('d/m/y'),
            ]);
    }
}