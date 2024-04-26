<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Tag;
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
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'status' => $request->status,
            'archived' => $request->archived,
            'date_completed' => $request->date_completed,
            'due_date' => $request->due_date,
        ]);

        $todo->tags()->sync($request->tags);

        if ($request->new_tags) {
            foreach ($request->new_tags as $tag) {
                $new_tag = Tag::create(['name' => $tag]);
                $todo->tags()->attach($new_tag);
            }
        }

        return $todo->fresh(['user', 'tags']);
    }

    public function show(Todo $todo)
    {
        if ($todo->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $todo->fresh(['user', 'tags']);
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
