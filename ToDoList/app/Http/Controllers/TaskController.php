<?php

namespace App\Http\Controllers;

use App\Models\Task;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::where('visible', '=', 1)
                ->orderBy('created_at', 'desc')
                ->get();

        $hidden_tasks_count = Task::where('visible', '=', 0)->count();

        return view('tasks.index', [
            'tasks' => $tasks,
            'hidden_tasks_count' => $hidden_tasks_count
        ]);
    }

    public function hide_task(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->visible = 0;
        $task->save();

        return redirect('/');
    }

    public function unhide_task(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->visible = 1;
        $task->save();

        return redirect('/hidden_tasks');
    }

    public function hidden_tasks(): View
    {
        $hidden_tasks = Task::where('visible', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tasks.hidden_tasks', ['hidden_tasks' => $hidden_tasks]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'task_text' => 'bail|required|string|max:255'
        ]);

        $task = new Task();
        $task->task_text = $request->input('task_text');
        $task->save();

        return redirect('/');
    }

    public function task_done(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->done = new DateTime();
        $task->save();

        return redirect('/');
    }

    public function task_undone(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->done = null;
        $task->save();

        return redirect('/');
    }

    public function task_edit(int $id): View
    {
        $task = Task::find($id);

        return view('tasks.edit', ['task' => $task]);
    }

    public function task_edit_submit(Request $request): RedirectResponse
    {
        $request->validate([
            'task_text' => 'bail|required|string|max:255'
        ]);

        $task = Task::find($request->input('id_task'));
        $task->task_text = $request->input('task_text');
        $task->save();

        return redirect('/');
    }

    public function task_delete(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }
}
