<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;  
        return view('dashboard', compact('tasks'));  
    }
    
    
    public function create()
    {
        return view('tasks.create');
    }
    
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'nullable|boolean', 
        ]);
    
       
        auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? $request->status : false,  
        ]);
    
        
        return redirect()->route('dashboard')->with('success', 'Taska eshte krijuar!');
    }
    
    
    public function edit(Task $task)
    {
        
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
    
       
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index');
        }
    
       
        $status = $request->has('status') ? true : false;
    
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status, 
        ]);
    
        return redirect()->route('tasks.index');
    }
    
    
    public function destroy(Task $task)
    {
    
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index');
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
