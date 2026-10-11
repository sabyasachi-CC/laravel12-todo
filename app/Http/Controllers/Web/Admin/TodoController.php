<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function __construct(private TodoService $service) {}

    public function index(Request $request): View
    {
        $todos = $this->service->listAll($request->only(['status', 'search', 'sort', 'per_page']));

        return view('admin.todos.index', compact('todos'));
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $this->service->delete($todo);

        return back()->with('success', 'Todo deleted successfully.');
    }
}
