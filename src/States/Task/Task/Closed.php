<?php

namespace Dpb\Package\TaskMS\States\Task\Task;

 class Closed extends TaskState
{
    public static $name = "closed";

    public function label():string {
        return __('tms-ui::tasks/task.states.closed');
    }    
}