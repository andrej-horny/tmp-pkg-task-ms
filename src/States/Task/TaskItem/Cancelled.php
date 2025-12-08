<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

 class Cancelled extends TaskItemState
{
    public static $name = "cancelled";

    public function label():string {
        return __('tms-ui::tasks/task-item.states.cancelled');
    }    
}