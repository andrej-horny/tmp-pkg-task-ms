<?php

namespace App\States\TS\TaskItem;

 class Cancelled extends TaskItemState
{
    public static $name = "cancelled";

    public function label():string {
        return __('tasks/task-item.states.cancelled');
    }    
}