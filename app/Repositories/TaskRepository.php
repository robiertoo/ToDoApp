<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    private $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        $this->model->create(
            ['name' => $request->name],
        );
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }
    
    public function update($request, $id)
    {
        $this->model->find($id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    public function complete_task($id)
    {
        $task = $this->model->find($id);
        $task->completed = true;
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task completed!');
    }
}