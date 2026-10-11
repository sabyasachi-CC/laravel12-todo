<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function paginate(array $filters = []): LengthAwarePaginator;

    public function update(User $user, array $data): User;

    public function delete(User $user): bool;
}
