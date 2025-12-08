<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

 class AwaitingParts extends TaskItemState
{
    public static $name = "awaiting-parts";

    public function label():string {
        return __('tms-ui::tasks/task-item.states.awaiting-parts');
    }    
}