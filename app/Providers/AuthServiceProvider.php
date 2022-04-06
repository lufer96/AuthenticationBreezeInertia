<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

    public function defineGatesTask(): void
    {
        Gate::define('task-update', function (User $user, Task $task) {
            return $user->id  === $task->user_id;
        });

        Gate::define('task-create', function (User $user) {
            return $user ? true : false;
        });

        Gate::define('task-delete', function (User $user, Task $task) {
            return $user->id === $task->user_id;
        });

        Gate::define('example-detail-response', function (User $user, Task $task) {
            return $user->id === $task->user_id ? Response::allow() : Response::deny('You are not the owner of this task');
        });
    }
}
