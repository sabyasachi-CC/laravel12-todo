<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    public function index(Request $request): View
    {
        $users = $this->service->list($request->only(['status', 'search', 'per_page']));

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->service->update($user, $request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->service->delete($user);

        return redirect()->route('admin.users.index')->with('success', 'User deactivated/deleted successfully.');
    }
}
