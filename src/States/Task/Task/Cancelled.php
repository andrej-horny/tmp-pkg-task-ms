<?php

namespace Dpb\Package\TaskMS\States\Task\Task;

 class Cancelled extends TaskState
{
    public static $name = "cancelled";

    public function label():string {
        return __('tms-ui::tasks/task.states.cancelled');
    }    
}