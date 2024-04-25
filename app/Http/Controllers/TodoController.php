<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function store(TodoRequest $request)
    {
        return Todo::create($request->validated());
    }

    public function show(Todo $todo)
    {
        return $todo;
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());

        return $todo;
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json();
    }
}
