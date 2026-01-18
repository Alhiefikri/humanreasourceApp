<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|string'
        ]);

        // Jika berhasil
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }
}
