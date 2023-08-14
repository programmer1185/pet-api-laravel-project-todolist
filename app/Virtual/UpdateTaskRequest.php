<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Update task request",
 *      description="Update task request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateTaskRequest
{
    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new task",
     *      example="A nice task"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @QA\Property(
     *      title="Priority"
     *      description="Priority task"
     *      format="int64"
     *      example=5
     * )
     *
     * @var integer
     */
    public $priority;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the new task",
     *      example="This is new task's description"
     * )
     *
     * @var string
     */
    public $description;
}
