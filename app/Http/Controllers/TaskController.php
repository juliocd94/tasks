<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => Task::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('task_images', 'public');
            $validated['image'] = $imagePath;
        }

        $task->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy($id): \Illuminate\Http\RedirectResponse
        {
        $task = Task::findOrFail($id);
        $task->delete();

        return back();
    }
}
