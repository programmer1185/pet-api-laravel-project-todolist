<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *         name="Task"
 *     )
 * )
 */
class Task
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

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
     *      title="Status"
     *      description="Task of status"
     *      property="status",
     *      type="integer",
     *      example=1
     * )
     *
     * @var integer
     */
    public $status;

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

    /**
     * @QA\Property(
     *      title="All Sub Tasks",
     *      description="All Sub Tasks",
     * )
     *
     * @var \App\Virtual\Models\Task[]
     */
    public $subTasks;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;
}
