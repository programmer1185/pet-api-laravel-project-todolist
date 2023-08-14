<?php

namespace App\DTO;

class UpdateTaskDto
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

    public function __construct(?string $title, ?int $priority, ?string $description) {
        $this->title = $title;
        $this->priority = $priority;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $attributes = [];

        if ($this->title) {
            $attributes['title'] = $this->title;
        }

        if ($this->priority) {
            $attributes['priority'] = $this->priority;
        }

        if ($this->description) {
            $attributes['description'] = $this->description;
        }

        return $attributes;
    }
}
