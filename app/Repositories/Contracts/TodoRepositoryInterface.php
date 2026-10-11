<?php

namespace App\Repositories\Contracts;

use App\Models\Todo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TodoRepositoryInterface
{
    public function findById(int $id): ?Todo;

    public function paginateForUser(int $userId, array $filters = []): LengthAwarePaginator;

    public function paginateAll(array $filters = []): LengthAwarePaginator;

    public function create(array $data): Todo;

    public function update(Todo $todo, array $data): Todo;

    public function delete(Todo $todo): bool;
}
