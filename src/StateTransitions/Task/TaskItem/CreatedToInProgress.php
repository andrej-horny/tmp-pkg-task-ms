<?php

namespace Dpb\Package\TaskMS\StateTransitions\Task\TaskItem;

use Dpb\Package\TaskMS\States\Task\TaskItem\Created;
use Dpb\Package\TaskMS\States\Task\TaskItem\InProgress;
use Dpb\Package\Tasks\Models\TaskItem;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\ModelStates\Transition;

class CreatedToInProgress extends Transition
{
    public function __construct(private TaskItem $taskItem, private Authenticatable $user) {}

    public function canTransition(): bool
    {
        $userCan = app()->runningInConsole() ? true : ($this->user->can('cancel-taskItem') || $this->user->hasRole('super-admin'));
        $validInitialState = $this->taskItem->state->equals(Created::class);
        return $userCan && $validInitialState;
    }

    public function handle(): ?TaskItem
    {
        if ($this->canTransition()) {

            $this->taskItem->state = new InProgress($this->taskItem);
            $this->taskItem->save();

            return $this->taskItem;
        }
        return null;
    }
}
