<?php

namespace App\States\TS\TaskItem;

 class Created extends TaskItemState
{
    public static $name = "created";

    public function label():string {
        return __('tasks/task-item.states.created');
    }
}