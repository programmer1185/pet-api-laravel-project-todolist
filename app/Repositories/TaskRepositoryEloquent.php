<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TaskRepository;
use App\Models\Task;
use App\Validators\TaskValidator;
use App\Presenters\TaskPresenter;

/**
 * Class TaskRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    public function presenter()
    {
        return TaskPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param int $id
     * @return bool
     */
    public function checkTaskMoveToDone(int $id): bool
    {
        $isAllowedToChange = true;

        $currentModel = $this->skipPresenter()->find($id);

        if ($currentModel->subTasks) {
            foreach($currentModel->subTasks as $subTask)
            {
                if ($subTask->status == Task::TASK_STATUS_TODO) {
                    $isAllowedToChange = false;
                    break;
                }

                if ($subTask->subTasks) {
                    $isAllowedToChange = $this->checkTaskMoveToDone($subTask->id);

                    if (!$isAllowedToChange) {
                        break;
                    }
                }
            }
        }

        return $isAllowedToChange;
    }

}
