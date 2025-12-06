<?php

namespace App\States\TS\TaskItem;

 class Closed extends TaskItemState
{
    public static $name = "closed";

    public function label():string {
        return __('tasks/task-item.states.closed');
    }    
}