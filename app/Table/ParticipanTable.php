<?php

namespace App\Table;

use App\Models\User;
use App\Enums\Gender;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ParticipanTable
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
            'gender' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'tanggal' => [
                'sortable' => true,
                'searchable' => true,
            ],
        ];
    }

    public function query(Request $request): LengthAwarePaginator
    {
        return User::query()->participan()
            ->paginate(10)->withQueryString()->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'tanggal' => $user->created_at->format('d/m/y'),
                'gender' => Gender::from($user->gender)->label(),
            ]);
    }
}
