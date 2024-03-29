<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Store a newly created task in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure it meets the specified rules.
        $validatedData = $request->validate([
            'user_name' => 'nullable|string|max:255', // User's name (optional)
            'task_description' => 'required|string',   // Description of the task (required)
            'priority' => 'required|string',            // Priority of the task (required)
            'due_date' => 'required|date',              // Due date of the task (required)
            'assignee' => 'nullable|string|max:255',    // Assignee of the task (optional)
        ]);

        // Create a new Task instance in the database using the validated data.
        // The Task model's 'create' method will automatically fill the model's attributes with the provided data and save it to the database.
        $task = Task::create($validatedData);

        // Return a JSON response with the newly created task and HTTP status code 201 (Created).
        return response()->json($task, 201);
    }

    /**
     * Fetch all tasks from the database.
     */
    public function index()
    {
        // Retrieve all tasks from the Task model
        $tasks = Task::all();

        // Return a JSON response with the tasks
        return response()->json($tasks);
    }

    /**
     * Update the specified task in the database.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data to ensure it meets the specified rules.
        $validatedData = $request->validate([
            'user_name' => 'nullable|string|max:255', // User's name (optional)
            'task_description' => 'required|string',   // Description of the task (required)
            'priority' => 'required|string',            // Priority of the task (required)
            'due_date' => 'required|date',              // Due date of the task (required)
            'assignee' => 'nullable|string|max:255',    // Assignee of the task (optional)
        ]);

        // Update the task instance with the validated data
        $task->update($validatedData);

        // Return a JSON response with the updated task
        return response()->json($task);
    }

    /**
     * Remove the specified task from the database.
     */
    public function destroy(Task $task)
    {
        // Delete the task from the database
        $task->delete();

        // Return a JSON response with a success message
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
