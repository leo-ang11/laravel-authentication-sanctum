<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks()->latest();

        if ($request->has('filter')) {
            if ($request->filter === 'completed') {
                $query->where('is_completed', '1');
            } elseif ($request->filter === 'pending') {
                $query->where('is_completed', '0');
            }
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
        ]);

        $request->user()->tasks()->create([
            'title' => $request->title,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }

        $task->delete();

        return redirect()->back();
    }

    public function toggle(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id){
            abort(403);
        }

        $task->update([
            'is_completed' => '1'
        ]);

        return redirect()->back();

    }

    public function edit(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));

    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }   

        $request->validate([
            'title' => 'required|min:3'
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index');

    }

}
