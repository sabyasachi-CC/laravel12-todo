<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Resources\Api\V1\TodoResource;
use App\Models\Todo;
use App\Services\TodoService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(private TodoService $service) {}

    public function index(Request $request)
    {
        $todos = $this->service->listForUser($request->user(), $request->only(['status', 'search', 'sort', 'per_page']));

        return ApiResponse::success(TodoResource::collection($todos), 'Todos retrieved.', 200, ['meta' => ['current_page' => $todos->currentPage(), 'last_page' => $todos->lastPage(), 'per_page' => $todos->perPage(), 'total' => $todos->total()]]);
    }

    public function store(StoreTodoRequest $request)
    {
        $this->authorize('create', Todo::class);
        $todo = $this->service->create($request->user(), $request->validated());

        return ApiResponse::success(new TodoResource($todo), 'Todo created successfully.', 201);
    }

    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);

        return ApiResponse::success(new TodoResource($todo->load('user')), 'Todo retrieved.');
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo = $this->service->update($todo, $request->validated());

        return ApiResponse::success(new TodoResource($todo), 'Todo updated successfully.');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $this->service->delete($todo);

        return ApiResponse::success(null, 'Todo deleted successfully.', 204);
    }
}
