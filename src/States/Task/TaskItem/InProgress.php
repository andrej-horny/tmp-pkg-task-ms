<?php

namespace App\States\TS\TaskItem;

 class InProgress extends TaskItemState
{
    public static $name = "in-progress";

    public function label():string {
        return __('tasks/task-item.states.in-progress');
    }    
}