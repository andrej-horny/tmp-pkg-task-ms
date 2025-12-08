<?php

namespace Dpb\Package\TaskMS\StateTransitions\Task\Task;

use Dpb\Package\TaskMS\States\Task\Task\Created;
use Dpb\Package\TaskMS\States\Task\Task\InProgress;
use Dpb\Package\Tasks\Models\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\ModelStates\Transition;

class CreatedToInProgress extends Transition
{
    public function __construct(private Task $task, private Authenticatable $user) {}

    public function canTransition(): bool
    {
        $userCan = app()->runningInConsole() ? true : ($this->user->can('cancel-task') || $this->user->hasRole('super-admin'));
        $validInitialState = $this->task->state->equals(Created::class);
        return $userCan && $validInitialState;
    }

    public function handle(): ?Task
    {
        if ($this->canTransition()) {

            $this->task->state = new InProgress($this->task);
            $this->task->save();

            return $this->task;
        }
        return null;
    }
}
