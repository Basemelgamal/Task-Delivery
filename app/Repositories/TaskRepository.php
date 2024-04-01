<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        return $this->task->all();
    }

    public function store($request)
    {
        return $this->task->create($request);
    }

    public function update($task, $request)
    {
        $task = $this->task->findOrFail($task->id);
        return $task->update($request);
    }

    public function destroy($task)
    {
        return $this->task->findOrFail($task->id)->delete();
    }
}
