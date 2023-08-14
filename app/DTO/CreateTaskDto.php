<?php

namespace App\DTO;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class CreateTaskDto
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var int
     */
    public $priority;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $parentId;

    public function __construct(string $title, int $priority, string $description, ?int $parentId) {
        $this->title = $title;
        $this->priority = $priority;
        $this->description = $description;

        if ($parentId) {
            $this->parentId = $parentId;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $attributes = [
            'title' => $this->title,
            'priority' => $this->priority,
            'description' => $this->description,
            'status' => Task::TASK_STATUS_TODO,
            'user_id' => Auth::user()->id
        ];

        if ($this->parentId) {
            $attributes['parent_id'] = $this->parentId;
        }

        return $attributes;
    }
}
