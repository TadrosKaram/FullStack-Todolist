<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
 public function toggle($id)
{
    $task = Task::findOrFail($id);
    $task->completed = !$task->completed;
    $task->save();

    return redirect()->back();
}


    // ✅ Index view, ordered by completed & due date
    public function index()
    {
        $tasks = Task::orderByDesc('completed')->orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('tasks.create');
    }

    // ✅ Store new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgent' => 'required|in:low,medium,high,critical',
            'start_type' => 'required|in:now,custom,estimated',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'estimated_minutes' => 'nullable|integer|min:1',
        ]);

        $validated['completed'] = false;

        // Set start_date and is_active logic
        if ($validated['start_type'] === 'now') {
            $validated['start_date'] = now();
            $validated['is_active'] = false;
        } elseif ($validated['start_type'] === 'custom') {
            $validated['is_active'] = false;
        } if ($validated['start_type'] === 'estimated') {
    $minutes = (int) $request->input('estimated_minutes'); 
    $validated['start_date'] = null;
    $validated['due_date'] = null;
    $validated['estimated_minutes'] = $minutes;
}


        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // ✅ Show edit form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // ✅ Update task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'urgent' => 'required|in:low,medium,high,critical',
            'start_type' => 'required|in:now,custom,estimated',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'estimated_minutes' => 'nullable|integer|min:1',
            'completed' => 'nullable|boolean',
        ]);

        $validated['completed'] = $request->has('completed');

        if ($validated['start_type'] === 'now') {
            $validated['start_date'] = now();
            $validated['is_active'] = false;
        } elseif ($validated['start_type'] === 'custom') {
            $validated['is_active'] = false;
        } elseif ($validated['start_type'] === 'estimated') {
            $validated['start_date'] = null;
            $validated['is_active'] = true;
        }

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    // ✅ Delete task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
