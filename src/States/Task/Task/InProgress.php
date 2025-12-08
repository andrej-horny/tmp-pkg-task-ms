<?php

namespace Dpb\Package\TaskMS\States\Task\Task;

 class InProgress extends TaskState
{
    public static $name = "in-progress";

    public function label():string {
        return __('tms-ui::tasks/task.states.in-progress');
    }    
}