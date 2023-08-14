<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\DTO\CreateTaskDto;
use App\DTO\UpdateTaskDto;
use Illuminate\Support\Carbon;
use App\Models\Task;

class TaskService
{
    /**
     * @var TaskRepository
     */
    protected $repository;

    public function __construct(TaskRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllTasks(): mixed
    {
        return $this->repository->all();
    }

    /**
     * @param CreateTaskDto $createTaskDto
     * @return mixed
     */
    public function createTask(CreateTaskDto $createTaskDto): mixed
    {
        return $this->repository->create($createTaskDto->toArray());
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id): mixed
    {
        return $this->repository->find($id);
    }

    /**
     * @param UpdateTaskDto $updateTaskDto
     * @param int $id
     * @return mixed
     */
    public function updateTask(UpdateTaskDto $updateTaskDto, int $id): mixed
    {
        return $this->repository->update($updateTaskDto->toArray(), $id);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\Response | mixed
     */
    public function deleteTask(Task $task): mixed
    {
        if ($task->status != Task::TASK_STATUS_DONE) {
            return $this->repository->delete($task->id);
        }

        return response("The task cannt be deleted", 422);

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response | mixed
     */
    public function changeTaskStatusToDone(int $id): mixed
    {
        if ($this->repository->checkTaskMoveToDone($id)) {
            return $this->repository->update(['status'=> Task::TASK_STATUS_DONE, "completed_at" => Carbon::now()], $id);
        }

        return response("The task cannt be completed", 422);

    }
}
