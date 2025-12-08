<?php

namespace Dpb\Package\TaskMS\States\Task\Task;

use Dpb\Package\TaskMS\StateTransitions\Task\Task\CreatedToInProgress;
use Dpb\Package\TaskMS\StateTransitions\Task\Task\InProgressToCancelled;
use Dpb\Package\Tasks\States\TaskState as BaseTaskState;
use Spatie\ModelStates\StateConfig;

abstract class TaskState extends BaseTaskState
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Created::class)
            ->allowTransition(Created::class, InProgress::class, CreatedToInProgress::class)
            ->allowTransition(InProgress::class, Closed::class)
            ->allowTransition(InProgress::class, Cancelled::class, InProgressToCancelled::class)
        ;
    }
}
