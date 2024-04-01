<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $input = [
            'tasks' => Task::all(),
        ];

        return view('tasks.index', $input);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $input = [
            'admins' => $adminRole->users
                ->pluck('name', 'id'),
            'users' => $userRole->users
                ->pluck('name', 'id'),
            'method'  => 'POST',
            'action'  => route('tasks.store'),
        ];

        return view('tasks.create', $input);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $input = [
            'admins' => User::admins()
                ->pluck('name', 'id'),
            'users' => User::users()
            ->pluck('name', 'id'),
            'task'  => $task,
            'method'  => 'PUT',
            'action'  => route('tasks.update', $task->id),
        ];

        return view('tasks.edit', $input);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
