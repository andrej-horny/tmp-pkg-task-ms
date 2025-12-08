<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

 class Closed extends TaskItemState
{
    public static $name = "closed";

    public function label():string {
        return __('tms-ui::tasks/task-item.states.closed');
    }    
}