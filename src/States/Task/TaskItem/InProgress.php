<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

 class InProgress extends TaskItemState
{
    public static $name = "in-progress";

    public function label():string {
        return __('tms-ui::tasks/task-item.states.in-progress');
    }    
}