<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ActionsController extends Controller
{
    public function hidden_tasks(): View
    {
        $hidden_tasks = Task::where('visible', '=', '0')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hidden_tasks', ['hidden_tasks' => $hidden_tasks]);
    }

    public function hide_task(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->visible = 0;
        $task->save();

        return redirect(route('tasks.index'));
    }

    public function unhide_task(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->visible = 1;
        $task->save();

        return redirect(route('tasks.index'));
    }

    public function task_done(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->done = new DateTime();
        $task->save();

        return redirect(route('tasks.index'));
    }

    public function task_undone(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->done = null;
        $task->save();

        return redirect(route('tasks.index'));
    }
}
