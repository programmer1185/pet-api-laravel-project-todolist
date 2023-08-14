<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    protected $service;

    public function __construct(TaskService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/tasks",
     *      operationId="getTasksList",
     *      tags={"Todo List"},
     *      summary="Get list of tasks",
     *      description="Returns list of tasks",
     *      @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Example: ?search=John",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Example: ?filter=id;title",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="orderBy",
     *         in="query",
     *         description="Example: ?orderBy=id",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="sortedBy",
     *         in="query",
     *         description="Example: ?sortedBy=desc",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskTransformer")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return $this->service->getAllTasks();
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *      path="/tasks",
     *      operationId="storeTask",
     *      tags={"Todo List"},
     *      summary="Store new task",
     *      description="Returns task data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateTaskRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable"
     *      )
     *     )
     */
    public function store(CreateTaskRequest $request)
    {
        return $this->service->createTask($request->getDto());
    }

    /**
     * Display the specified resource.
     * * @OA\Get(
     *      path="/tasks/{id}",
     *      operationId="getTaskById",
     *      tags={"Todo List"},
     *      summary="Get task information",
     *      description="Returns task data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function show(int $id)
    {
        return $this->service->findById($id);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Patch(
     *      path="/tasks/{id}",
     *      operationId="updateTask",
     *      tags={"Todo List"},
     *      summary="Update existing task",
     *      description="Returns updated task data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateTaskRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        return $this->service->updateTask($request->getDto(), $task->id);
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *      path="/task/{id}",
     *      operationId="deleteTask",
     *      tags={"Todo List"},
     *      summary="Delete existing task",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);
        return $this->service->deleteTask($task);
    }

    /**
     * @OA\Patch(
     *      path="/tasks/{id}/change-to-done",
     *      operationId="changeTaskStatusToDone",
     *      tags={"Todo List"},
     *      summary="Change task status",
     *      description="Returns updated task data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function changeTaskStatusToDone(int $id)
    {
        return $this->service->changeTaskStatusToDone($id);
    }
}
