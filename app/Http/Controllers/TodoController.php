<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TodoController extends Controller
{
    public function index(Request $request)
    {

        $todos = QueryBuilder::for(Todo::class)
            ->where('user_id', auth()->user()->id)
            ->with(['user', 'tags'])
            ->allowedFilters('title', 'body', 'status')
            ->allowedSorts('title', 'body', 'status')
            ->paginate($request->per_page ?? 10);

        return response()->json($todos);

    }

    public function store(TodoRequest $request)
    {
        return Auth::user()->todos()->create($request->validated());
    }

    public function show(Todo $todo)
    {
        if ($todo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $todo;
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        if ($todo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $todo->update($request->validated());

        return $todo;
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $todo->delete();

        return response()->json();
    }
}
