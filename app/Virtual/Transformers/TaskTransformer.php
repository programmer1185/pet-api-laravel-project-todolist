<?php

namespace App\Virtual\Transformers;

/**
 * @OA\Schema(
 *     title="TaskTransformer",
 *     description="Task resource",
 *     @OA\Xml(
 *         name="TaskTransformer"
 *     )
 * )
 */
class TaskTransformer
{
/**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Task[]
     */
    private $data;
}
