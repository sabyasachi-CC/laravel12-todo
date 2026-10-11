<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\User;
use App\Repositories\Contracts\TodoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TodoService
{
    public function __construct(private TodoRepositoryInterface $todos) {}

    public function listForUser(User $user, array $filters = []): LengthAwarePaginator
    {
        return $this->todos->paginateForUser($user->id, $filters);
    }

    public function listAll(array $filters = []): LengthAwarePaginator
    {
        return $this->todos->paginateAll($filters);
    }

    public function create(User $user, array $data): Todo
    {
        return DB::transaction(fn () => $this->todos->create([...$data, 'user_id' => $user->id]));
    }

    public function update(Todo $todo, array $data): Todo
    {
        return DB::transaction(fn () => $this->todos->update($todo, $data));
    }

    public function delete(Todo $todo): bool
    {
        return DB::transaction(fn () => $this->todos->delete($todo));
    }
}
