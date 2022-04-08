<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskRepository
{
    /**
     * @var User
     */
    private $userAuthenticated;

    /**
     * @param Task $task
     * @param User $user
     */
    public function __construct(private Task $task, Authenticatable $user)
    {
        $this->userAuthenticated = $user;
    }

    public function getQuery(): Builder
    {
        return $this->task::query();
    }

    // public function newInstance(): Task
    // {
    //     return $this->task->newInstance();
    // }

    public function getByUuid(string $uuid): Model
    {
        return $this->getQuery()->firstWhere('uuid_key', $uuid);
    }

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userAuthenticated->tasks()->paginate($perPage);
    }

    public function create(array $attributes): Model
    {
        /** $modelInstance = $this->newInstance()->fill($attributes);
         * return $this->userAuthenticated->tasks()->save($modelInstance); */
        return $this->userAuthenticated->tasks()->create($attributes);
    }

    public function update(array $attributes, Task $task): Model
    {
        $task->update($attributes);
        return $task;
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function resolve($task)
    {
        if ($task instanceof Task)
            return $task;

        if (is_string($task))
            return $this->getByUuid($task);

        throw new ModelNotFoundException();
    }
}
