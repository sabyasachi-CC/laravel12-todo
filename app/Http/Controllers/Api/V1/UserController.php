<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $users = $this->service->list($request->only(['status', 'search', 'per_page']));

        return ApiResponse::success(UserResource::collection($users), 'Users retrieved.', 200, ['meta' => ['current_page' => $users->currentPage(), 'last_page' => $users->lastPage(), 'total' => $users->total()]]);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return ApiResponse::success(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        return ApiResponse::success(new UserResource($this->service->update($user, $request->validated())), 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->service->delete($user);

        return ApiResponse::success(null, 'User deleted successfully.', 204);
    }
}
