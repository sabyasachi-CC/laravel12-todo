<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        $q = User::query()->orderBy('created_at', 'desc');
        if (isset($filters['status']) && $filters['status'] !== '') {
            $q->where('status', (bool) $filters['status']);
        }

        if (! empty($filters['search'])) {
            $q->where(fn ($x) => $x->where('first_name', 'like', '%'.$filters['search'].'%')->orWhere('last_name', 'like', '%'.$filters['search'].'%')->orWhere('email', 'like', '%'.$filters['search'].'%'));
        }

        return $q->paginate($filters['per_page'] ?? 15)->withQueryString();
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->refresh();
    }

    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}
