<?php

namespace Dpb\Package\TaskMS\States\Task\Task;

 class Created extends TaskState
{
    public static $name = "created";

    public function label():string {
        return __('tms-ui::tasks/task.states.created');
    }
}