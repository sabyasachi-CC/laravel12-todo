<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct(private UserRepositoryInterface $users) {}

    public function list(array $filters = []): LengthAwarePaginator
    {
        return $this->users->paginate($filters);
    }

    public function update(User $user, array $data): User
    {
        return DB::transaction(fn () => $this->users->update($user, $data));
    }

    public function delete(User $user): bool
    {
        return DB::transaction(fn () => $this->users->delete($user));
    }
}
