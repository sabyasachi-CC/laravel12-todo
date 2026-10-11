<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function __construct(private TodoService $service) {}

    public function index(Request $request): View
    {
        $todos = $this->service->listForUser($request->user(), $request->only(['status', 'search', 'sort', 'per_page']));

        return view('todos.index', compact('todos'));
    }

    public function create(): View
    {
        return view('todos.create');
    }

    public function store(StoreTodoRequest $request): RedirectResponse
    {
        $this->authorize('create', Todo::class);
        $this->service->create($request->user(), $request->validated());

        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
    }

    public function show(Todo $todo): View
    {
        $this->authorize('view', $todo);

        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo): View
    {
        $this->authorize('update', $todo);

        return view('todos.edit', compact('todo'));
    }

    public function update(UpdateTodoRequest $request, Todo $todo): RedirectResponse
    {
        $this->service->update($todo, $request->validated());

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorize('delete', $todo);
        $this->service->delete($todo);

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully.');
    }
}
