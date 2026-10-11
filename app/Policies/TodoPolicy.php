<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

class TodoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isActive();
    }

    public function view(User $user, Todo $todo): bool
    {
        return $user->isAdmin() || $todo->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isActive();
    }

    public function update(User $user, Todo $todo): bool
    {
        return $user->isAdmin() || $todo->user_id === $user->id;
    }

    public function delete(User $user, Todo $todo): bool
    {
        return $user->isAdmin() || $todo->user_id === $user->id;
    }

    public function restore(User $user, Todo $todo): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Todo $todo): bool
    {
        return $user->isAdmin();
    }

    public function activate(User $user, Todo $todo): bool
    {
        return $this->update($user, $todo);
    }

    public function deactivate(User $user, Todo $todo): bool
    {
        return $this->update($user, $todo);
    }
}
