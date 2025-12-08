<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

use Dpb\Package\TaskMS\StateTransitions\Task\TaskItem\CreatedToInProgress;
use Dpb\Package\TaskMS\StateTransitions\Task\TaskItem\InProgressToCancelled;
use Dpb\Package\Tasks\States\TaskItemState as BaseTaskItemState;
use Spatie\ModelStates\StateConfig;

abstract class TaskItemState extends BaseTaskItemState
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
