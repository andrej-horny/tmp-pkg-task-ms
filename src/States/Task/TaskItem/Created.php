<?php

namespace Dpb\Package\TaskMS\States\Task\TaskItem;

 class Created extends TaskItemState
{
    public static $name = "created";

    public function label():string {
        return __('tms-ui::tasks/task-item.states.created');
    }
}