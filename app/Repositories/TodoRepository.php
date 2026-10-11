<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TodoRepository implements TodoRepositoryInterface
{
    public function findById(int $id): ?Todo
    {
        return Todo::with('user')->find($id);
    }

    public function paginateForUser(int $userId, array $filters = []): LengthAwarePaginator
    {
        return $this->baseQuery($filters)
            ->where('user_id', $userId)
            ->with('user')
            ->paginate($filters['per_page'] ?? 15)
            ->withQueryString();
    }

    public function paginateAll(array $filters = []): LengthAwarePaginator
    {
        return $this->baseQuery($filters)
            ->with('user')
            ->paginate($filters['per_page'] ?? 15)
            ->withQueryString();
    }

    public function create(array $data): Todo
    {
        return Todo::create($data)->load('user');
    }

    public function update(Todo $todo, array $data): Todo
    {
        $todo->update($data);

        return $todo->refresh()->load('user');
    }

    public function delete(Todo $todo): bool
    {
        return (bool) $todo->delete();
    }

    private function baseQuery(array $filters)
    {
        $query = Todo::query();
        if (array_key_exists('status', $filters) && $filters['status'] !== '') {
            $query->where('status', (bool) $filters['status']);
        }

        if (! empty($filters['search'])) {
            $query->where('title', 'like', '%'.$filters['search'].'%');
        }

        $sort = $filters['sort'] ?? '-created_at';
        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $column = ltrim($sort, '-');
        if (! in_array($column, ['created_at', 'updated_at', 'title', 'status'], true)) {
            $column = 'created_at';
        }

        return $query->orderBy($column, $direction);
    }
}
